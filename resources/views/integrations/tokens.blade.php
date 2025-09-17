@extends('templates.app')

@section('body')
@php
  // Resolve a ação do submit (com fallback se a rota não existir)
  $saveAction = \Illuminate\Support\Facades\Route::has('integrations.upsert')
      ? route('integrations.upsert')
      : (\Illuminate\Support\Facades\Route::has('integrations.update')
          ? route('integrations.update')
          : url('/integrations/tokens'));
@endphp

<div class="sgpa-integrations py-4">
  {{-- Corrige centralização global do template e limita largura --}}
  <style>
    .sgpa-integrations { text-align: left; }
    .sgpa-integrations .page-wrap { max-width: 900px; margin: 0 auto; }
    .sgpa-integrations .card { border-radius: .6rem; }
    .sgpa-integrations .input-group .btn { min-width: 42px; }
    @media (max-width: 576px){ .sgpa-integrations .page-title-wrap { gap: .5rem!important; } }
  </style>

  <div class="page-wrap">
    <div class="d-flex align-items-center justify-content-between gap-2 page-title-wrap mb-3">
      <h1 class="h5 mb-0">Gerenciar Tokens de Integração</h1>
    </div>

    {{-- Feedbacks --}}
    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Corrija os erros abaixo:</strong>
        <ul class="mb-0">
          @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
      </div>
    @endif

    <div class="alert alert-info d-flex align-items-start gap-2">
      <i class="bi bi-shield-lock mt-1"></i>
      <div>
        Por segurança, tokens já salvos <u>não são exibidos</u>. Deixe o campo em branco para manter o token atual
        ou preencha para substituí-lo. Para remover um token, use o botão <strong>Remover</strong>.
      </div>
    </div>

    {{-- FORM PRINCIPAL (apenas um) --}}
    <form id="integrations-form" action="{{ $saveAction }}" method="POST" novalidate>
      @csrf

      @foreach ($systems as $system)
        @php
          $hasToken = isset($tokens[$system]) && !empty($tokens[$system]);
          $inputId  = 'token-' . $loop->index;
          // URL de delete com fallback
          $deleteUrl = \Illuminate\Support\Facades\Route::has('integrations.delete')
              ? route('integrations.delete', ['name' => $system])
              : url('/integrations/tokens/' . urlencode($system));
        @endphp

        <div class="card shadow-sm mb-3">
          <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
              <span class="fw-semibold">{{ $system }}</span>
              @if($hasToken)
                <span class="badge text-bg-success">Adicionado</span>
              @else
                <span class="badge text-bg-secondary">Sem token</span>
              @endif
            </div>

            <div class="d-flex align-items-center gap-2">
              <button type="button" class="btn btn-outline-secondary btn-sm"
                      data-action="paste" data-target="#{{ $inputId }}" title="Colar do clipboard">
                <i class="bi bi-clipboard-plus"></i> Colar
              </button>
              {{-- Botão de Remover (sem form aninhado) --}}
              <button type="button" class="btn btn-outline-danger btn-sm"
                      data-action="delete" data-url="{{ $deleteUrl }}"
                      {{ $hasToken ? '' : 'disabled' }}>
                <i class="bi bi-trash"></i> Remover
              </button>
            </div>
          </div>

          <div class="card-body">
            <label for="{{ $inputId }}" class="form-label mb-1">Token para {{ $system }}</label>
            <div class="input-group">
              <input
                type="password"
                name="systems[{{ $system }}]"
                id="{{ $inputId }}"
                class="form-control @error('systems.' . $system) is-invalid @enderror"
                placeholder="{{ $hasToken ? '•••••••• (deixe em branco para manter)' : 'Insira o token do ' . $system }}"
                value="{{ $hasToken ? '' : old('systems.' . $system) }}"
                autocomplete="new-password"
              >
              <button class="btn btn-outline-secondary" type="button"
                      data-action="toggle" data-target="#{{ $inputId }}" title="Mostrar/ocultar">
                <i class="bi bi-eye"></i>
              </button>
              <button class="btn btn-outline-secondary" type="button"
                      data-action="clear" data-target="#{{ $inputId }}" title="Limpar">
                <i class="bi bi-x-circle"></i>
              </button>
            </div>
            @error('systems.' . $system)
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            <small class="text-muted d-block mt-1">
              {{ $hasToken ? 'Um token já está salvo. Deixe em branco para manter.' : 'Nenhum token cadastrado ainda.' }}
            </small>
          </div>
        </div>
      @endforeach

      {{-- Botão único de salvar todas as alterações --}}
      <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-lg" style="background-color: #972E3F; color: white">
          <i class="bi bi-check2-circle"></i> Salvar todas as alterações
        </button>
      </div>
    </form>

    {{-- Form oculto único para exclusões (fora do form principal) --}}
    <form id="deleteForm" method="POST" style="display:none;">
      @csrf
      @method('DELETE')
    </form>
  </div>
</div>

{{-- JS inline (não depende de @stack) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const $  = (s, c=document) => c.querySelector(s);
  const $$ = (s, c=document) => Array.from(c.querySelectorAll(s));

  // Mostrar/ocultar senha
  $$('#integrations-form [data-action="toggle"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = $(btn.dataset.target);
      if (!target) return;
      const isPwd = target.type === 'password';
      target.type = isPwd ? 'text' : 'password';
      btn.innerHTML = isPwd ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
      target.focus();
    });
  });

  // Limpar campo
  $$('#integrations-form [data-action="clear"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = $(btn.dataset.target);
      if (!target) return;
      target.value = '';
      target.focus();
    });
  });

  // Colar do clipboard (com fallback para prompt)
  $$('#integrations-form [data-action="paste"]').forEach(btn => {
    btn.addEventListener('click', async () => {
      const target = $(btn.dataset.target);
      if (!target) return;
      try {
        if (navigator.clipboard && navigator.clipboard.readText) {
          const text = await navigator.clipboard.readText();
          target.value = text;
        } else {
          throw new Error('clipboard API indisponível');
        }
      } catch (e) {
        const manual = prompt('Cole o token aqui:');
        if (manual !== null) target.value = manual;
      }
      target.focus();
    });
  });

  // Remover token (usa form oculto fora do form principal)
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action="delete"]');
    if (!btn) return;
    const url = btn.dataset.url;
    if (!url) return;
    if (!confirm('Tem certeza que deseja remover este token?')) return;
    const form = document.getElementById('deleteForm');
    form.setAttribute('action', url);
    form.submit();
  });
});
</script>
@endsection
