<div class="modal " id="modal_show{{ $vinculo['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            @can('visualizar vinculo estudante-edital')
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Vínculo</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Título</label>
                        <div class="textoinfomodal"> {{ $vinculo['titulo'] }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Semestre de Início</label>
                        <div class="textoinfomodal"> {{ $vinculo['semestre'] }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Descrição</label>
                        <div class="textoinfomodal"> {{ $vinculo['descricao'] }} </div>
                    </div>
                    @if ($vinculo['tipo'] === 'vinculado')
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Valor da Bolsa</label>
                            <div class="textoinfomodal">
                                @if ($vinculo['valor_bolsa'])
                                    {{ $vinculo['valor_bolsa'] }}
                                @else
                                    {{ 'Não possui' }}
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Data de início</label>
                        <div class="textoinfomodal"> {{ $edital['data_inicio']->format('d/m/Y') }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Data de fim</label>
                        <div class="textoinfomodal"> {{ $edital['data_fim']->format('d/m/Y') }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Programa</label>
                        <div class="textoinfomodal"> {{ $vinculo['programa'] }} </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Disciplina(s)</label>
                        <div class="textoinfomodal">
                            @if (array_key_exists('disciplinas', $vinculo) && $vinculo['disciplinas']->isNotEmpty())
                                @foreach ($vinculo['disciplinas'] as $disciplina)
                                    {{ $disciplina->nome }}<br>
                                @endforeach
                            @else
                                {{ 'Não há disciplinas' }}
                            @endif
                        </div>
                    </div>

                    @if (array_key_exists('aluno', $vinculo))
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Nome do Aluno</label>
                            <div class="textoinfomodal"> {{ $vinculo['aluno']['nome'] }} </div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">CPF do Aluno</label>
                            <div class="textoinfomodal"> {{ $vinculo['aluno']['cpf'] }} </div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Bolsista?</label>
                            @if ($vinculo['bolsista'] == 1)
                                <div class="textoinfomodal">Sim</div>
                            @else
                                <div class="textoinfomodal">Não</div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="modal-footer border-0"></div>
            </div>
        @else
            <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
            <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
        @endcan
    </div>
</div>
</div>
