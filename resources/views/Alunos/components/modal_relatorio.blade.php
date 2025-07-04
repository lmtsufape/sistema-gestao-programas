<!-- Modal -->
@php
    $vinculo = App\Models\EditalAlunoOrientadors::where('edital_id', $edital->id)->whereHas('aluno', function ($query) {
        $query->where('cpf', Auth::user()->cpf);})->firstOrFail();

    $relatorio_enviado = App\Models\RelatorioFinal::where('edital_aluno_orientador_id', $vinculo->id)->first();
@endphp

<div class="modal " tabindex="-1" aria-hidden="true" id="modal_relatorio_{{ $edital->id }}">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Relatório Final</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ Route('relatorio.enviar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(!$relatorio_enviado)
                    <div class="modal-body" style="text-align: start">
                        <input class="w-75 form-control" type="file" name="relatorio_final" id="relatorio_final" title="Envie seu relatório final" required>
                    </div>

                    <input type="hidden" name="edital_id" value="{{$edital->id}}">

                    <div class="modal-footer border-0 mb-3">
                        <button type="submit" class="botaosalvar">Enviar</button>
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
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
