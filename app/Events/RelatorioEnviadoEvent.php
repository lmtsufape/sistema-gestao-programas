<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\RelatorioFinal;

class RelatorioEnviadoEvent implements ShouldBroadcast
{
    use InteractsWithSockets;

    public $relatorio;

    public function __construct(RelatorioFinal $relatorio)
    {
        $this->relatorio = $relatorio;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('programas-channel');
    }

    public function broadcastAs()
    {
        return 'RelatorioEnviado';
    }

    public function broadcastWith()
    {
        return [
            'mensagem' => "O aluno {$this->relatorio->editalAlunoOrientador->aluno->user->name} enviou um novo relatório.",
            'link' => url("/edital/{$this->relatorio->editalAlunoOrientador->edital->id}/alunos?modal={$this->relatorio->editalAlunoOrientador->id}"),
            'relatorio_id' => $this->relatorio->id,
        ];
    }
}
