<!-- Modal de Envio/Reenvio de Relatório Final -->
@php
    $vinculo = App\Models\EditalAlunoOrientadors::where('edital_id', $edital->id)
        ->whereHas('aluno', fn($q) => $q->where('cpf', Auth::user()->cpf))
        ->firstOrFail();
    $relatorio_enviado = App\Models\RelatorioFinal::where('edital_aluno_orientador_id', $vinculo->id)->first();
@endphp

<div class="modal" id="modal_relatorio_{{ $id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
    <div class="modal-content shadow-lg rounded-3">

      <!-- Header -->
      <div class="modal-header text-white border-0 py-3 px-4 rounded-top" style="background-color: #972E3F">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-file-earmark-arrow-up-fill me-2"></i>
          Relatório Final
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('relatorio.enviar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="edital_id" value="{{ $edital->id }}">

        @if (!$relatorio_enviado)
          <div class="modal-body py-4 px-5">
            <div class="row g-4">
              <div class="col-12">
                <label for="relatorio_final" class="form-label text-muted small">Envie seu relatório final</label>
                <input type="file"
                       class="form-control form-control-sm"
                       name="relatorio_final"
                       id="relatorio_final"
                       required>
              </div>
            </div>
          </div>

          <div class="modal-footer border-0 px-5 pb-4">
            <button type="submit" class="btn" style="background-color: #972E3F">
              <i class="bi bi-send-fill me-1"></i> Enviar
            </button>
          </div>

        @else
          @php
            $status = $relatorio_enviado->status;
            $statusLabel = $relatorio_enviado->status_label;
          @endphp

          <div class="modal-body py-4 px-5">
            <div class="row g-4">

              <div class="col-md-6">
                <label class="form-label text-muted small">Status</label>
                <div class="fw-semibold" style="color: {{ $relatorio_enviado->status_color }};">
                  Enviado – {{ $statusLabel }}
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label text-muted small">Status</label>
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

              <div class="col-md-6">
                <label class="form-label text-muted small mb-0 me-2">Baixar Relatório</label>
                <a href="{{ route('relatorio.download', $relatorio_enviado->id) }}"
                   target="_blank"
                   class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-download"></i>
                </a>
              </div>

              <div class="col-md-6">
                <label class="form-label text-muted small mb-0 me-2">Visualizar Relatório</label>
                <a href="{{ route('relatorio.visualizar', $relatorio_enviado->id) }}"
                   target="_blank"
                   class="btn btn-outline-secondary btn-sm">
                  <i class="bi bi-eye-fill"></i>
                </a>
              </div>

              @if ($status !== 1)
                <div class="col-12">
                  <label for="parecer" class="form-label text-muted small">Parecer</label>
                  <textarea class="form-control" rows="3" disabled>{{ $relatorio_enviado->parecer ?? 'Nenhum parecer disponível' }}</textarea>
                </div>
              @endif

              @if ($status === 3)
                <div class="col-12">
                  <label for="relatorio_final" class="form-label text-muted small">Reenvie seu relatório</label>
                  <input type="file"
                         class="form-control form-control-sm"
                         name="relatorio_final"
                         id="relatorio_final"
                         required>
                </div>
              @endif

            </div>
          </div>

          @if ($status === 3)
            <div class="modal-footer border-0 px-5 pb-4">
              <button type="submit" class="btn" style="background-color: #972E3F; color: white;">
                <i class="bi bi-arrow-repeat me-1"></i> Reenviar
              </button>
            </div>
          @endif

        @endif
      </form>
    </div>
  </div>
</div>
