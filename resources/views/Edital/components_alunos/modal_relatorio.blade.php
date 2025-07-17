@php
    $relatorio_enviado = App\Models\RelatorioFinal::where('edital_aluno_orientador_id', $vinculo->id)->first();
@endphp

<!-- Modal Blade -->
<div class="modal" id="modal_relatorio_{{ $id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
    <div class="modal-content shadow-lg rounded-3">

      <!-- Header -->
      <div class="modal-header text-white border-0 py-3 px-4 rounded-top" style="background-color: #972E3F">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-file-earmark-text-fill me-2"></i>
          Relatório Final
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      @php
        $status = $relatorio_enviado?->status;
        $statusLabel = $relatorio_enviado?->status_label;
      @endphp

      @if (!$relatorio_enviado)
        <div class="modal-body py-4 px-5">
          <div class="alert alert-secondary mb-0">
            <i class="bi bi-exclamation-circle-fill me-1"></i>
            <strong>Status:</strong> Não enviado
          </div>
        </div>
      @else
        <form id="parecer-form" action="{{ route('relatorio.parecer') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="relatorio_id" value="{{ $relatorio_enviado->id }}">

          <div class="modal-body py-4 px-5">
            <div class="row g-4">

              <div class="col-md-6">
                <label class="form-label text-muted small">Status</label>
                <div class="fw-semibold">{{ $statusLabel ? "Enviado – $statusLabel" : 'Enviado' }}</div>
              </div>

              <div class="col-md-6">
                <label class="form-label text-muted small">Data de Envio</label>
                <div class="fw-semibold">{{ $relatorio_enviado->created_at->format('d/m/Y H:i') }}</div>
              </div>

              <div class="col-md-6">
                <label class="form-label text-muted small">Semestre</label>
                <div class="fw-semibold">{{ $edital->semestre }}</div>
              </div>

              <div class="col-md-6">
                <label class="form-label text-muted small">Programa</label>
                <div class="fw-semibold">{{ $edital->programa->nome }}</div>
              </div>

              <div class="col-md-6 align-items-center">
                <label class="form-label text-muted small mb-0 me-2">Baixar Relatório</label>
                <a href="{{ route('relatorio.download', $relatorio_enviado->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-download"></i>
                </a>
              </div>

              <div class="col-md-6 align-items-center">
                <label class="form-label text-muted small mb-0 me-2">Visualizar Relatório</label>
                <a href="{{ route('relatorio.visualizar', $relatorio_enviado->id) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                  <i class="bi bi-eye-fill"></i>
                </a>
              </div>

              @if ($relatorio_enviado->parecer && auth()->user()->typage_type !== App\Models\Aluno::class)
                <div class="col-12">
                  <label class="form-label text-muted small">Parecer Anterior</label>
                  <textarea class="form-control" rows="3" disabled>{{ $relatorio_enviado->parecer }}</textarea>
                </div>
              @endif

              @if ($status === 1)
                <div class="col-12">
                  <label for="parecer" class="form-label text-muted small">Digite seu Parecer (opcional)</label>
                  <textarea class="form-control" name="parecer" id="parecer" rows="5" placeholder="Seu parecer aqui..."></textarea>
                </div>
              @endif

            </div>
          </div>

          @if (in_array($status, [1,2,3]))
            <div class="modal-footer border-0 px-5 pb-4">
              @if ($status === 1)
                <button type="button" class="btn btn-outline-warning" onclick="confirmParecer('devolver')">
                  <i class="bi bi-arrow-counterclockwise me-1"></i> Devolver
                </button>
                <button type="button" class="btn btn-success ms-3" onclick="confirmParecer('aprovar')">
                  <i class="bi bi-check2-circle me-1"></i> Aprovar
                </button>

                {{-- Hidden submits --}}
                <button type="submit" name="status" value="3" id="devolver-btn" hidden></button>
                <button type="submit" name="status" value="2" id="aprovar-btn" hidden></button>
              @else
                <button type="button" class="btn {{ $status === 2 ? 'btn-success' : 'btn-warning' }} w-100" disabled>
                  {{ $statusLabel }}
                </button>
              @endif
            </div>
          @endif
        </form>
      @endif

    </div>
  </div>
</div>

<script>
    function confirmParecer(acao) {
        let mensagem = acao === 'aprovar' ?
            'Tem certeza que deseja aprovar este relatório?' :
            'Tem certeza que deseja devolver este relatório?';

        if (confirm(mensagem)) {
            const btn = document.getElementById(acao + '-btn');
            if (btn) btn.click();
        }
    }
</script>
