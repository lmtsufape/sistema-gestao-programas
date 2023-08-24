@canany(['admin', 'servidor', 'aluno', 'orientador'])
    <div class="modal " id="modal_show{{ $vinculo->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Vínculo</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Título:</label>
                        <div class="textoinfomodal"> {{ $vinculo->edital->titulo_edital }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Semestre de Início:</label>
                        <div class="textoinfomodal"> {{ $vinculo->edital->semestre }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Descrição:</label>
                        <div class="textoinfomodal"> {{ $vinculo->edital->descricao }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Valor da Bolsa:</label>
                        <div class="textoinfomodal">
                            @if ($vinculo->edital->valor_bolsa)
                                {{ $vinculo->edital->valor_bolsa }}
                            @else
                                {{ 'Não possui' }}
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Data de início:</label>
                        <div class="textoinfomodal"> {{ date_format(date_create($vinculo->edital->data_inicio), 'd/m/Y') }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Data de fim:</label>
                        <div class="textoinfomodal"> {{ date_format(date_create($vinculo->edital->data_fim), 'd/m/Y') }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Programa:</label>
                        <div class="textoinfomodal"> {{ $vinculo->edital->programa->nome }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Disciplina(s):</label>
                        <div class="textoinfomodal">
                            @if (count($vinculo->edital->disciplinas) != 0)
                                @foreach ($vinculo->edital->disciplinas as $disciplina)
                                    {{ $disciplina->nome }}<br>
                                @endforeach
                            @else
                                {{ 'Não há disciplinas' }}
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Nome do Aluno:</label>
                        <div class="textoinfomodal"> {{ $vinculo->aluno->user->name }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">CPF do Aluno:</label>
                        <div class="textoinfomodal"> {{ $vinculo->aluno->cpf }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Bolsista?:</label>
                        @if ($vinculo->bolsista == 1)
                            <div class="textoinfomodal">Sim</div>
                        @else
                            <div class="textoinfomodal">Não</div>
                        @endif

                    </div>
                </div>

                <div class="modal-footer border-0"></div>
            </div>
        </div>

    </div>
    </div>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
@endcan
