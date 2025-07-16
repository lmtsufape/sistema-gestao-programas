// public/js/notificacoes.js

document.addEventListener('DOMContentLoaded', function () {
    try {
        Echo.connector.pusher.logToConsole = true;
    } catch (e) {
        console.warn('Não foi possível ativar logs do Pusher:', e.message);
    }

    const userId = document.head.querySelector('meta[name="user-id"]')?.content;

    if (!userId) {
        console.warn('ID do usuário não encontrado.');
        return;
    }

    Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            console.log('Notificação recebida:', notification);
            Livewire.emit('atualizarNotificacoes');
        });
});
