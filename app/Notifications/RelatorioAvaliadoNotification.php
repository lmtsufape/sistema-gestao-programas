<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RelatorioAvaliadoNotification extends Notification
{
    use Queueable;

    protected $relatorio;

    public function __construct($relatorio)
    {
        $this->relatorio = $relatorio;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
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
}
