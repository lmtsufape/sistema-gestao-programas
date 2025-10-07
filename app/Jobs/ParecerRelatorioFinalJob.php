<?php

namespace App\Jobs;

use App\Models\RelatorioFinal;
use App\Models\SistemaExterno;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;

class ParecerRelatorioFinalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 4; // numero de tentativas
    public $timeout = 30; // tempo limite para cada tentativa em segundos
    public $backoff = [30, 60, 300]; // Atraso entre tentativas em segundos

    protected $relatorioId;

    public function __construct($relatorioId)
    {
        $this->relatorioId = $relatorioId;
    }

    public function handle()
    {
        try {
            $relatorio = RelatorioFinal::findOrFail($this->relatorioId);

            // Define o período do relatório com base no semestre do edital
            $semestre = $relatorio->editalAlunoOrientador->edital->semestre;
            $parts = explode('.', $semestre);
            $ano = intval($parts[0]);
            $semestre_num = intval($parts[1]);

            if ($semestre_num == 1) {
                $dataInicio = Carbon::createFromDate($ano, 1, 1);
                $dataFim = Carbon::createFromDate($ano, 6, 30);
            } else {
                $dataInicio = Carbon::createFromDate($ano, 7, 1);
                $dataFim = Carbon::createFromDate($ano, 12, 31);
            }

            // Monta o JSON conforme a especificação
            $natureza = $relatorio->editalAlunoOrientador->edital->programa->nome;
            $json = [
                [
                    'titulo' => "Relatório Final - $natureza $semestre",
                    'inicio' => $dataInicio->format('Y-m-d'),
                    'fim' => $dataFim->format('Y-m-d'),
                    'natureza' => $natureza,
                    'atividades' => [
                        [
                            'descricao' => $relatorio->editalAlunoOrientador->titulo,
                            'inicio' => Carbon::parse($relatorio->editalAlunoOrientador->data_inicio)->format('Y-m-d'),
                            'fim' => Carbon::parse($relatorio->editalAlunoOrientador->data_fim)->format('Y-m-d'),
                            'participantes' => [
                                [
                                    'nome' => $relatorio->editalAlunoOrientador->aluno->user->name,
                                    'email' => $relatorio->editalAlunoOrientador->aluno->user->email,
                                    'cpf' => $relatorio->editalAlunoOrientador->aluno->user->cpf,
                                    'carga' => $relatorio->carga_horaria,
                                    'curso' => $relatorio->editalAlunoOrientador->aluno->curso->nome
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            // Funcionalidade de envio para sistema externo
            $sistema = SistemaExterno::where('name', 'Certifica')->first();
            $url = config('services.certifica.url');
            $endpoint = config('services.certifica.endpoint');

            // Verifica se o sistema externo e o token estão configurados
            if (!$sistema || !$sistema->api_token || !$url || !$endpoint) {
                Log::warning('External system configuration not found or incomplete', [
                    'system' => $sistema ? $sistema->name : 'not set',
                    'url' => $url ?? 'not set',
                    'endpoint' => $endpoint ?? 'not set',
                    'api_token' => $sistema && $sistema->api_token ? 'set' : 'not set',
                ]);
                $this->fail();
                return;
            }

            // Tenta enviar a requisição para o sistema externo e registra logs
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $sistema->api_token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($url . $endpoint, $json);

            if ($response->successful()) {
                $sistema->update(['last_used_at' => now()]);
                Log::info('O JSON foi enviado com sucesso.', [
                    'system' => $sistema->name,
                    'url' => $url,
                    'response_status' => $response->status(),
                    'relatorio_id' => $this->relatorioId,
                ]);
            } else {
                throw new RequestException($response);
            }
        } catch (RequestException | ConnectionException $e) {
            // Falha na comunicação externa (i.e., erro de http ou problema na rede)
            Log::error('Falha na comunicação com o sistema externo.', [
                'system' => $sistema->name,
                'url' => $url,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'relatorio_id' => $this->relatorioId,
                'attempt' => $this->attempts(),
            ]);
            throw $e;
        } catch (\Exception $e) {
            // Falha no sistema interno (i.e., banco de dados, dados inválidos)
            Log::error('Falha interna.', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'relatorio_id' => $this->relatorioId,
            ]);
            $this->fail();
        }
    }
}
