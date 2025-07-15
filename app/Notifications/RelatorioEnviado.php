<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\RelatorioFinal;

class RelatorioEnviado extends Notification implements ShouldQueue
{
    use Queueable;

    protected $relatorio;

    public function __construct(RelatorioFinal $relatorio)
    {
        $this->relatorio = $relatorio;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Novo Relatório Enviado')
                    ->line("O aluno {$this->relatorio->name} enviou um novo relatório.")
                    ->action('Visualizar Relatório', url("/edital/{$this->relatorio->editalAlunoOrientador->edital->id}/alunos"));
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensagem' => "O aluno {$this->relatorio->editalAlunoOrientador->aluno->user->name} enviou um novo relatório.",
            'aluno_id' => $this->relatorio->editalAlunoOrientador->aluno->id,
            'relatorio_id' => $this->relatorio->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'mensagem' => "O aluno {$this->relatorio->editalAlunoOrientador->aluno->user->name} enviou um novo relatório.",
            'aluno_id' => $this->relatorio->editalAlunoOrientador->aluno->id,
            'relatorio_id' => $this->relatorio->id,
        ]);
    }
}
