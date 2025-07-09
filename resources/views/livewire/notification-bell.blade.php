<div class="dropdown align-self-center me-5" wire:poll.10s>
    <a href="#" class="position-relative d-inline-block" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell fa-2x text-dark"></i>

        @if ($this->notificacoes->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $this->notificacoes->count() }}
            </span>
        @endif
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow mt-2" style="width: 300px;">
        <li class="dropdown-header d-flex justify-content-between align-items-center px-3 py-2">
            <span>Notificações</span>
            @if ($this->notificacoes->count() > 0)
                <button wire:click="marcarTodasComoLidas" class="btn btn-sm btn-link p-0">Marcar como lidas</button>
            @endif
        </li>

        <li>
            <hr class="dropdown-divider my-0">
        </li>

        @forelse ($this->notificacoes as $notificacao)
            @if ($notificacao->data['link'] ?? false)
                <a href="{{ $notificacao->data['link'] }}"
                    class="d-block px-3 py-2 text-decoration-none text-dark hover-notificacao">
                    <div class="small">{{ $notificacao->data['mensagem'] }}</div>
                    <div class="text-muted small">{{ $notificacao->created_at->diffForHumans() }}</div>
                </a>
            @else
                <li class="px-3 py-2">
                    <div class="small">{{ $notificacao->data['mensagem'] }}</div>
                    <div class="text-muted small">{{ $notificacao->created_at->diffForHumans() }}</div>
                </li>
            @endif
        @empty
            <li class="text-center text-muted py-2">Sem novas notificações</li>
        @endforelse
    </ul>
</div>

<style>
    .hover-notificacao:hover {
        background-color: #dddddd;
        transition: background-color 0.2s ease;
    }
</style>
