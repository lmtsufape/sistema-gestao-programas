@php
    $relatorio_enviado = App\Models\RelatorioFinal::where('edital_aluno_orientador_id', $vinculo->id)->first();
@endphp

<div class="modal" tabindex="-1" aria-hidden="true" id="modal_relatorio_{{ $vinculo->id }}">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Relatório Final</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            @php
                $status = $relatorio_enviado?->status;
                $statusLabel = $relatorio_enviado?->status_label;
            @endphp

            @if (!$relatorio_enviado)
                <div class="modal-body" style="text-align: start">
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Status</label>
                        <div class="textoinfomodal">Não enviado</div>
                    </div>
                </div>
            @else
                <form id="parecer-form" action="{{ route('relatorio.parecer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="relatorio_id" value="{{ $relatorio_enviado->id }}">

                    <div class="modal-body" style="text-align: start">
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Status</label>
                            <div class="textoinfomodal">Enviado - {{ $relatorio_enviado->status_label }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Data de envio inicial</label>
                            <div class="textoinfomodal">{{ $relatorio_enviado->created_at->format('d/m/Y H:i') }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Semestre</label>
                            <div class="textoinfomodal">{{ $edital->semestre }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Programa</label>
                            <div class="textoinfomodal">{{ $edital->programa->nome }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Baixar</label>
                            <div>
                                <a href="{{ route('relatorio.download', ['relatorio_id' => $relatorio_enviado->id]) }}" target="_blank">
                                    <img src="{{ asset('images/download.svg') }}" alt="Download relatório final" style="height: 30px; width: 30px;" title="Download relatório final">
                                </a>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Visualizar</label>
                            <div>
                                <a href="{{ route('relatorio.visualizar', ['relatorio_id' => $relatorio_enviado->id]) }}" target="_blank">
                                    <img src="{{ asset('images/eye-fill.svg') }}" alt="Visualizar relatório final" style="height: 30px; width: 30px;" title="Visualizar relatório final">
                                </a>
                            </div>
                        </div>

                        @if ($status === 1)
                            <div class="mb-3">
                                <label class="tituloinfomodal form-label mt-3" for="parecer">Parecer</label>
                                <textarea class="form-control" name="parecer" id="parecer" rows="3" placeholder="Digite um parecer (opcional)"></textarea>
                            </div>
                        @endif
                    </div>

                    @if (in_array($status, [1, 2, 3]))
                        <div class="modal-footer border-0 d-flex {{ $status === 1 ? 'justify-content-center' : 'justify-content-between' }} mt-4">
                            @if ($status === 1)
                                <button type="button" class="btn btn-warning" onclick="confirmParecer('devolver')">
                                    Devolver
                                </button>

                                <button type="button" class="btn btn-success me-2" onclick="confirmParecer('aprovar')">
                                    Aprovar
                                </button>

                                {{-- Botões invisíveis --}}
                                <button type="submit" name="status" value="3" id="devolver-btn" hidden></button>
                                <button type="submit" name="status" value="2" id="aprovar-btn" hidden></button>
                            @else
                                <button type="button" class="btn {{ $status === 2 ? 'btn-success' : 'btn-warning' }} mb-3" disabled>
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
        let mensagem = acao === 'aprovar'
            ? 'Tem certeza que deseja aprovar este relatório?'
            : 'Tem certeza que deseja devolver este relatório?';

        if (confirm(mensagem)) {
            const btn = document.getElementById(acao + '-btn');
            if (btn) btn.click();
        }
    }
</script>
