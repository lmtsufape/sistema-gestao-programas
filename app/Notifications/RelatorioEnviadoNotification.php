<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\RelatorioFinal;

class RelatorioEnviadoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $relatorio;

    public function __construct(RelatorioFinal $relatorio)
    {
        $this->relatorio = $relatorio;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Novo Relatório Enviado')
                    ->line("O aluno {$this->relatorio->name} enviou um novo relatório.")
                    ->action('Visualizar Relatório', url("/edital/{$this->relatorio->editalAlunoOrientador->edital->id}/alunos?modal={$this->relatorio->editalAlunoOrientador->id}"));
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensagem' => "O aluno {$this->relatorio->editalAlunoOrientador->aluno->user->name} enviou um novo relatório.",
            'link' => url("/edital/{$this->relatorio->editalAlunoOrientador->edital->id}/alunos?modal={$this->relatorio->editalAlunoOrientador->id}")
        ];
    }
}
