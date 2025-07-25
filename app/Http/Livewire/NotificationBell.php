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
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
