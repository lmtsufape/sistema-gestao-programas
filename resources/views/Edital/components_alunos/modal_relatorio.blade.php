<!-- Modal -->
@php
    $relatorio_enviado = App\Models\RelatorioFinal::where('edital_aluno_orientador_id', $vinculo->id)->first();
@endphp

<div class="modal " tabindex="-1" aria-hidden="true" id="modal_relatorio">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Relatório Final</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            @if(!$relatorio_enviado)
                <div class="modal-body" style="text-align: start">
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Status</label>
                        <div class="textoinfomodal">
                            Não enviado </div>
                    </div>
                </div>
            @else
                <div class="modal-body" style="text-align: start">
                    <div class="modal-body" style="text-align: start">
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Status</label>
                            <div class="textoinfomodal">
                                Enviado - {{ $relatorio_enviado->status_label }} </div>
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Semestre</label>
                            <div class="textoinfomodal">
                                {{ $edital->semestre }} </div>
                        </div>
                
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Programa</label>
                            <div class="textoinfomodal">{{ $edital->programa->nome }} </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Baixar</label>
                            <div>
                                <a type="button"
                                    href="{{ route('relatorio.download', ['relatorio_id' => $relatorio_enviado->id]) }}"
                                    target="_blank">
                                    <img src="{{ asset('images/download.svg') }}" alt="Download relatório final"
                                        style="height: 30px; width: 30px; " title="Download relatório final">
                                </a>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Visualizar</label>
                            <div>
                                <a href="{{ route('relatorio.visualizar', ['relatorio_id' => $relatorio_enviado->id]) }}" target="_blank">
                                    <img src="{{ asset('images/eye-fill.svg') }}" alt="Visualizar relatório final"
                                        style="height: 30px; width: 30px;" title="Visualizar relatório final">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                    </div>
                </div>
            @endif

            @if($relatorio_enviado?->status === 1)
                <div class="modal-footer border-0 d-flex justify-content-center mt-4">
                    <form action="{{ route('relatorio.parecer') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="relatorio_id" id="parecer" value="{{ $relatorio_enviado->id }}">
                            
                        <button type="submit" class="btn btn-warning" name="parecer" value="3">
                            Devolver
                        </button>

                        <button type="submit" class="btn btn-success me-2" name="parecer" value="2">
                            Aprovar
                        </button>
                    </form>
                </div>
            @elseif($relatorio_enviado?->status === 2)
                <div class="modal-footer border-0 d-flex justify-content-between mt-4">
                    <button type="" class="btn btn-success">
                        {{ $relatorio_enviado->status_label }}
                    </button>
                </div>
            @elseif($relatorio_enviado?->status === 3)
                <div class="modal-footer border-0 d-flex justify-content-between mt-4">
                        <button type="" class="btn btn-warning mb-3">
                            {{ $relatorio_enviado->status_label }}
                        </button>
                </div>
            @endif
        </div>
    </div>
</div>