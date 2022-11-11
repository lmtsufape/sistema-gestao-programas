<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Aluno;
use App\Models\Vinculo;
use App\Models\Frequencia_mensal;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VinculoController extends Controller
{

    public function index(Request $request)
    {
        if (isset(auth()->user()->typage_type) && auth()->user()->typage_type == "App\Models\Servidor") {
            $professors = Professor::all();
            $alunos = Aluno::all();
            for ($i = 0; $i < count($alunos); $i++) {
                $vinculosDoAluno = $alunos[$i]->vinculos;
                foreach ($vinculosDoAluno as $vinculo) {
                    if ($vinculo->status == "ANDAMENTO" and $vinculo->bolsa == "REMUNERADA") {
                        $alunos[$i]['proibido'] = true; //variável que vai indicar que aluno está proibido de ter outro vinculo remunerado
                        break;
                    }
                }
            }

            $search = $request->search;
            $programa = $request->programa;

            $vinculos = Vinculo::join("alunos", "vinculos.aluno_id", "=", "alunos.id")->join("professors", "vinculos.professor_id", "=", "professors.id");
            $vinculos = $vinculos->where(function ($query) use ($search, $programa) {
                if ($search) {
                    $query->orWhere("alunos.cpf", "LIKE", "%{$search}%");
                    $query->orWhere("professors.nome", "LIKE", "%{$search}%");
                    $query->orWhere("professors.cpf", "LIKE", "%{$search}%");
                    $query->orWhere("professors.siape", "LIKE", "%{$search}%");
                    $query->orWhere("vinculos.bolsa", "LIKE", "%{$search}%");
                }

                if ($programa) {
                    $query->where("vinculos.programa", "=", "{$search}");
                }
            })->orderBy('vinculos.created_at', 'desc')->select("vinculos.*")->get();
        } else if (isset(auth()->user()->typage_type) && auth()->user()->typage_type == "App\Models\Aluno") {
            $vinculos = auth()->user()->typage->vinculos;
            $professors = [];
            $alunos = [];
            $search = $request->search;
        } else {
            return redirect(url("/login"));
        }
        $auth = auth()->user();
        return view("vinculos.index", compact('vinculos', 'professors', 'alunos', 'search', 'auth'));
    }

    public function store(Request $request)
    {
        $validacao = $request->validate(
            [
                'alunos' => ['required'],
                'professores' => ['required'],
                'programa' => ['required'],
                'semestre' => ['required'],
                'bolsa' => ['required'],
                'valor-bolsa' => ['required_if:bolsa,==,REMUNERADA'],
                'curso' => ['required_if:programa,==,MONITORIA', 'required_if:programa,==,TUTORIA'],
                'disciplina' => ['required_if:programa,==,MONITORIA', 'required_if:programa,==,TUTORIA'],
                'data-inicio' => ['required'],
                'data-fim' => ['required']
            ],
            [
                'required' => 'O campo :attribute é obrigatório.',
                'valor-bolsa.required_if' => 'O campo valor da bolsa é obrigatório.',
                'curso.required_if' => 'O campo curso é obrigatório.'
            ]
        );

        $vinculo = Vinculo::Create([
            'bolsa' => $request->input('bolsa'),
            'programa' =>  $request->input('programa'),
            'valor_bolsa' => $request->input('valor-bolsa'),
            'disciplina' => $request->input('disciplina'),
            'curso' => $request->input('curso'),
            'semestre' => $request->input('semestre'),
            'data_inicio' => $request->input('data-inicio'),
            'data_fim' => $request->input('data-fim'),
            'aluno_id' => $request->input('alunos'),
            'professor_id' => $request->input('professores')
        ]);

        if ($vinculo) {
            return redirect(route("vinculos.index"));
        }
    }

    public function update(Request $request)
    {
        $validacao = $request->validate(
            [
                'id' => ['required'],
                'alunos' => ['required'],
                'professores' => ['required'],
                'programa' => ['required'],
                'semestre' => ['required'],
                'bolsa' => ['required'],
                'valor-bolsa' => ['required_if:bolsa,==,REMUNERADA'],
                'curso' => ['required_if:programa,==,MONITORIA', 'required_if:programa,==,TUTORIA'],
                'disciplina' => ['required_if:programa,==,MONITORIA', 'required_if:programa,==,TUTORIA'],
                'data-inicio' => ['required'],
                'data-fim' => ['required']
            ],
            [
                'required' => 'O campo :attribute é obrigatório.',
                'valor-bolsa.required_if' => 'O campo valor da bolsa é obrigatório.',
                'curso.required_if' => 'O campo curso é obrigatório.'
            ]
        );

        $vinculo = Vinculo::find($request->id);
        $vinculo->aluno_id = $request->alunos;
        $vinculo->professor_id = $request->professores;
        $vinculo->programa = $request->programa;
        $vinculo->semestre = $request->semestre;
        $vinculo->bolsa = $request->bolsa;
        $vinculo->valor_bolsa = $request->input('valor-bolsa');
        $vinculo->curso = $request->curso;
        $vinculo->disciplina = $request->disciplina;
        $vinculo->data_inicio = $request->input('data-inicio');
        $vinculo->data_fim = $request->input('data-fim');

        $vinculo->update();

        return redirect(route("vinculos.index"));
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $vinculo = Vinculo::find($id);
        $vinculo->status = "CANCELADA";
        $vinculo->update();
        return redirect(route("vinculos.index"));
    }

    public function frequenciaMensal($idVinculo)
    {
        return view("vinculos.frequencia_mensal", compact('idVinculo'));
    }

    public function salvarFrequenciaMensal(Request $request)
    {
        $validacao = $request->validate(
            [
                'mes' => ['required'],
            ],
            [
                'required' => 'O campo :attribute é obrigatório.'
            ]
        );
        $dias = [];
        $tempoTotal = 0;

        if ($request->dia1) {
            $dias['dia1'] = intval($request->dia1);
            $tempoTotal += intval($request->dia1);
        }
        if ($request->dia2) {
            $dias['dia2'] = intval($request->dia2);
            $tempoTotal += intval($request->dia2);
        }
        if ($request->dia3) {
            $dias['dia3'] = intval($request->dia3);
            $tempoTotal += intval($request->dia3);
        }
        if ($request->dia4) {
            $dias['dia4'] = intval($request->dia4);
            $tempoTotal += intval($request->dia4);
        }
        if ($request->dia5) {
            $dias['dia5'] = intval($request->dia5);
            $tempoTotal += intval($request->dia5);
        }
        if ($request->dia6) {
            $dias['dia6'] = intval($request->dia6);
            $tempoTotal += intval($request->dia6);
        }
        if ($request->dia7) {
            $dias['dia7'] = intval($request->dia7);
            $tempoTotal += intval($request->dia7);
        }
        if ($request->dia8) {
            $dias['dia8'] = intval($request->dia8);
            $tempoTotal += intval($request->dia8);
        }
        if ($request->dia9) {
            $dias['dia9'] = intval($request->dia9);
            $tempoTotal += intval($request->dia9);
        }
        if ($request->dia10) {
            $dias['dia10'] = intval($request->dia10);
            $tempoTotal += intval($request->dia10);
        }
        if ($request->dia11) {
            $dias['dia11'] = intval($request->dia11);
            $tempoTotal += intval($request->dia11);
        }
        if ($request->dia12) {
            $dias['dia12'] = intval($request->dia12);
            $tempoTotal += intval($request->dia12);
        }
        if ($request->dia13) {
            $dias['dia13'] = intval($request->dia13);
            $tempoTotal += intval($request->dia13);
        }
        if ($request->dia14) {
            $dias['dia14'] = intval($request->dia14);
            $tempoTotal += intval($request->dia14);
        }
        if ($request->dia15) {
            $dias['dia15'] = intval($request->dia15);
            $tempoTotal += intval($request->dia15);
        }
        if ($request->dia16) {
            $dias['dia16'] = intval($request->dia16);
            $tempoTotal += intval($request->dia16);
        }
        if ($request->dia17) {
            $dias['dia17'] = intval($request->dia17);
            $tempoTotal += intval($request->dia17);
        }
        if ($request->dia18) {
            $dias['dia18'] = intval($request->dia18);
            $tempoTotal += intval($request->dia18);
        }
        if ($request->dia19) {
            $dias['dia19'] = intval($request->dia19);
            $tempoTotal += intval($request->dia19);
        }
        if ($request->dia20) {
            $dias['dia20'] = intval($request->dia20);
            $tempoTotal += intval($request->dia20);
        }
        if ($request->dia21) {
            $dias['dia21'] = intval($request->dia21);
            $tempoTotal += intval($request->dia21);
        }
        if ($request->dia22) {
            $dias['dia22'] = intval($request->dia22);
            $tempoTotal += intval($request->dia22);
        }
        if ($request->dia23) {
            $dias['dia23'] = intval($request->dia23);
            $tempoTotal += intval($request->dia23);
        }
        if ($request->dia24) {
            $dias['dia24'] = intval($request->dia24);
            $tempoTotal += intval($request->dia24);
        }
        if ($request->dia25) {
            $dias['dia25'] = intval($request->dia25);
            $tempoTotal += intval($request->dia25);
        }
        if ($request->dia26) {
            $dias['dia26'] = intval($request->dia26);
            $tempoTotal += intval($request->dia26);
        }
        if ($request->dia27) {
            $dias['dia27'] = intval($request->dia27);
            $tempoTotal += intval($request->dia27);
        }
        if ($request->dia28) {
            $dias['dia28'] = intval($request->dia28);
            $tempoTotal += intval($request->dia28);
        }
        if ($request->dia29) {
            $dias['dia29'] = intval($request->dia29);
            $tempoTotal += intval($request->dia29);
        }
        if ($request->dia30) {
            $dias['dia30'] = intval($request->dia30);
            $tempoTotal += intval($request->dia30);
        }
        if ($request->dia31) {
            $dias['dia31'] = intval($request->dia31);
            $tempoTotal += intval($request->dia31);
        }

        $frequenciaMensal = Frequencia_mensal::create([
            'mes' => $request->mes,
            'frequencia' => json_encode($dias),
            'tempo_total' => $tempoTotal,
            'vinculo_id' => intval($request->idVinculo)
        ]);

        $meses = [
            "1" => [31, "janeiro"],
            "2" => [29, "fevereiro"],
            "3" => [31, "março"],
            "4" => [30, "abril"],
            "5" => [31, "maio"],
            "6" => [30, "junho"],
            "7" => [31, "julho"],
            "8" => [31, "agosto"],
            "9" => [30, "setembro"],
            "10" => [31, "outubro"],
            "11" => [30, "novembro"],
            "12" => [31, "dezembro"]
        ];

        $email_params = [
            "frequenciaMensal" => $frequenciaMensal,
            "frequencia" => (array)json_decode($frequenciaMensal->frequencia),
            "aluno" => $frequenciaMensal->vinculo->aluno,
            "vinculo" => $frequenciaMensal->vinculo,
            "professor" => $frequenciaMensal->vinculo->professor,
            "mes" => $meses[$frequenciaMensal->mes][1],
            "qntDiasMes" => $meses[$frequenciaMensal->mes][0]
        ];

        Mail::send("email.avaliacao_freq_mensal", $email_params, function ($mail) use ($frequenciaMensal, $meses) {
            $mail->from("tjdvprogramaacademicos@gmail.com", "TJDV Programas Acadêmicos - UFAPE");
            $mail->subject("Frenquência mensal de " . $meses[$frequenciaMensal->mes][1] . " do aluno: {$frequenciaMensal->vinculo->aluno->user->name} - {$frequenciaMensal->vinculo->aluno->cpf}");
            $mail->to($frequenciaMensal->vinculo->professor->email);
        });

        return redirect(route("vinculos.index"));
    }

    public function avaliar_frequencia_mensal(Request $request)
    {

        $frequencia = Frequencia_mensal::find($request->id_frequencia);

        if ($frequencia->status == "aprovada") {
            return "Esta Frequência Mensal já foi finalizado, não é possível fazer mais alterações.";
        }

        $frequencia->status = $request->status;
        $frequencia->observacao = $request->observacao;

        if ($frequencia->status == "aprovada") {
            $frequencia->vinculo->quantidade_horas = $frequencia->vinculo->quantidade_horas + $frequencia->tempo_total;
            $frequencia->vinculo->update();
        }

        if ($frequencia->save()) {
            return "Frequência mensal avaliada com sucesso.";
        } else {
            return "Algo deu errado. Tente novamente mais tarde!";
        }
    }

    public function certificacao(Request $request, $id)
    {
        $request->validate(
            [
                "programa" => ['required']
            ],
            [
                'required' => 'O campo :attribute é obrigatório.'
            ]
        );

        $programa = strtolower($request->programa);
        $vinculo = Vinculo::find($id);

        $pdf = FacadePdf::loadView("vinculos/pdfs/certificados/{$programa}", compact("vinculo"));

        return $pdf->setPaper('A4', 'landscape')->stream("{$vinculo->aluno->nome}-{$vinculo->data_fim}-{$vinculo->programa}.pdf");
    }

    public function declaracao(Request $request, $id)
    {
        $request->validate(
            [
                "programa" => ['required']
            ],
            [
                'required' => 'O campo :attribute é obrigatório.'
            ]
        );

        $programa = strtolower($request->programa);
        $vinculo = Vinculo::find($id);

        $pdf = FacadePdf::loadView("vinculos/pdfs/declaracoes/{$programa}", compact("vinculo"));

        return $pdf->setPaper('A4',)->stream("{$vinculo->aluno->nome}-{$vinculo->data_fim}-{$vinculo->programa}.pdf");
    }


    public function relatorio(Request $request)
    {
        $request->validate(

            [
                "relatorio" => [
                    'max: 2048',
                    'mimes:pdf'
                ]
            ],
            [
                'max' => 'Arquivo muito grande!',
                'mimes' => 'Arquivo precisa ser uma extensão .pdf!'
            ]

        );

        $vinculo = Vinculo::find($request->id);
        if ($request->relatorio) {

            if (Storage::exists($vinculo->relatorio)) {
                Storage::delete($vinculo->relatorio);
            }
            $relatorio = $request->relatorio->storeAs($vinculo->aluno->cpf, "{$vinculo->id}.pdf");

            if ($vinculo->update(["relatorio" => $relatorio, "status_relatorio" => "ENVIADO"])) {
                $email_params = ["professor" => $vinculo->professor, "aluno" => $vinculo->aluno, "vinculo" => $vinculo];
                Mail::send("email.avaliacao_rel_final", $email_params, function ($mail) use ($vinculo) {
                    $mail->from("tjdvprogramaacademicos@gmail.com", "TJDV Programas Acadêmicos - UFAPE");
                    $mail->subject("Relatório final do aluno: {$vinculo->aluno->user->name} - {$vinculo->aluno->cpf}");
                    $mail->attach(storage_path("app/public/{$vinculo->aluno->cpf}/{$vinculo->id}.pdf"));
                    $mail->to($vinculo->professor->email);
                });
            }
        }

        return redirect(route("vinculos.index"));
    }

    public function avaliar_relatorio_final(Request $request)
    {
        $vinculo = Vinculo::find($request->id_vinculo);

        if ($vinculo->status == "CONCLUIDA" || $vinculo->status == "CANCELADA") {
            return "Este vínculo já foi finalizado, não é possível fazer mais alterações.";
        }

        $vinculo->status_relatorio = $request->status_relatorio;
        $vinculo->observacao_relatorio = $request->observacao;

        if ($vinculo->status_relatorio == "APROVADO") {
            $vinculo->status = "CONCLUIDA";
        }

        if ($vinculo->save()) {
            return "Relatório avaliado com sucesso.";
        } else {
            return "Algo deu errado. Tente novamente mais tarde!";
        }
    }

    public function getFrequencia($idVinculo, $mes)
    {
        $frequenciaMensal = Frequencia_mensal::where('vinculo_id', $idVinculo)->where('mes', $mes)->first();
        if (isset($frequenciaMensal->frequencia)) {
            return $frequenciaMensal;
        } else {
            return "nao existe";
        }
    }
}
