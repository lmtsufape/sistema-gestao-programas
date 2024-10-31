<div class="modal " id="modal_show{{ $edital->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content modal-create p-2">
                @canany(['visualizar proprio edital', 'visualizar edital'])
                    <div class="modal-header border-0">
                        <p class="titulomodal">Informações do Edital</p>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align: start">
                        <div class="modal-body" style="text-align: start">
                            <div class="mb-3">
                                <label class="tituloinfomodal form-label mt-3">Título</label>
                                <div class="textoinfomodal">
                                    {{ $edital->titulo_edital }} </div>
                            </div>
                            <div class="mb-3">
                                <label class="tituloinfomodal form-label mt-3">Semestre de Início</label>
                                <div class="textoinfomodal">
                                    {{ $edital->semestre }} </div>
                            </div>
                            <div class="mb-3">
                                <label class="tituloinfomodal form-label mt-3">Descrição</label>
                                <div class="textoinfomodal">{{ $edital->descricao }} </div>
                            </div>
                            <div class="mb-3">

                                <label class="tituloinfomodal form-label mt-3">Valor da Bolsa</label>
                                <div class="textoinfomodal">
                                    @if ($edital->valor_bolsa)
                                        {{ $edital->valor_bolsa }}
                                    @else
                                        {{ 'Não possui' }}
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">

                                <label class="tituloinfomodal form-label mt-3">Data de início</label>
                                <div class="textoinfomodal">{{ date_format(date_create($edital->data_inicio), 'd/m/Y') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="tituloinfomodal form-label mt-3">Data de fim</label>
                                <div class="textoinfomodal">{{ date_format(date_create($edital->data_fim), 'd/m/Y') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="tituloinfomodal form-label mt-3">Programa</label>
                                <div class="textoinfomodal">{{ $edital->programa->nome }} </div>
                            </div>
                            <div class="mb-3">
                                <label class="tituloinfomodal form-label mt-3">Disciplina(s)</label>
                                <div class="textoinfomodal">
                                    @if (count($edital->disciplinas) != 0)
                                        @foreach ($edital->disciplinas as $disciplina)
                                            {{ $disciplina->nome }}<br>
                                        @endforeach
                                    @else
                                        {{ 'Não há disciplinas' }}
                                    @endif
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer border-0">
                        </div>
                    </div>
                @else
                    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
                    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
                @endcanany
            </div>

        </div>
    </div>
    <style>
        .btn {
            color: #fff;
            background: #34A853;
            border-color: #34A853;
            border-radius: 20px;
            width: 120px;
        }

        .btn:hover {
            background-color: #40b760;
            border-color: #40b760;
            color: #fff;
        }
    </style>
