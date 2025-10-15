<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    protected $listeners = ['atualizarNotificacoes' => '$refresh'];

    public function getNotificacoesProperty()
    {
        return auth()->user()->unreadNotifications;
    }

    public function marcarTodasComoLidas()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        $user->refresh();
        $this->emitSelf('$refresh');
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
