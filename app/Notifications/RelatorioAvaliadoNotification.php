<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\RelatorioFinal;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RelatorioAvaliadoNotification extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    protected $relatorio;

    public function __construct(RelatorioFinal $relatorio)
    {
        $this->relatorio = $relatorio;
    }

    public function broadcastOn()
    {
        return new PrivateChannel("App.Models.User.{$this->relatorio->editalAlunoOrientador->aluno->user->id}");
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        $mensagem = $this->relatorio->statusKey === 'aprovado'
            ? 'Seu relatório foi aprovado!'
            : 'Seu relatório foi devolvido para correções.';

        return (new MailMessage)
            ->subject('Atualização do seu relatório')
            ->line($mensagem)
            ->action('Ver relatório', url("/editais-aluno?modal={$this->relatorio->editalAlunoOrientador->id}"));
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensagem' => $this->relatorio->statusKey === 'aprovado'
                ? 'Seu relatório foi aprovado!'
                : 'Seu relatório foi devolvido para correções.',
            'link' => url("/editais-aluno?modal={$this->relatorio->editalAlunoOrientador->id}")
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'mensagem' => $this->relatorio->statusKey === 'aprovado'
                ? 'Seu relatório foi aprovado!'
                : 'Seu relatório foi devolvido para correções.',
            'link' => url("/editais-aluno?modal={$this->relatorio->editalAlunoOrientador->id}")
        ]);
    }
}
