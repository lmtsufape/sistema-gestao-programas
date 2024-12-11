<div class="modal " id="modal_show{{ $estagio->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            @can('visualizar estagio')
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Estágio</p>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align: start">
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Status</label>
                            <div class="textoinfomodal">
                                @if ($estagio->status == 0)
                                    {{ 'Inativo' }}
                                @else
                                    {{ 'Ativo' }}
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">

                            <label class="tituloinfomodal form-label mt-3">Descrição</label>
                            <div class="textoinfomodal"> {{ $estagio->descricao }} </div>
                        </div>
                        <div class="mb-3">

                            <label class="tituloinfomodal form-label mt-3">Tipo</label>
                            <div class="textoinfomodal">
                                @if ($estagio->tipo == 'eno')
                                    {{ 'Não-Obrigatório' }}
                                @else
                                    {{ 'Obrigatório' }}
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Data de início</label>
                            <div class="textoinfomodal"> {{ date_format(date_create($estagio->data_inicio), 'd/m/Y') }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Data de fim</label>
                            <div class="textoinfomodal"> {{ date_format(date_create($estagio->data_fim), 'd/m/Y') }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Data da solicitação</label>
                            <div class="textoinfomodal"> {{ date_format(date_create($estagio->data_solicitacao), 'd/m/Y') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Docente</label>
                            <div class="textoinfomodal"> {{ $estagio->orientador->user->name }} </div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Discente</label>
                            <div class="textoinfomodal"> {{ $estagio->aluno->nome_aluno }} </div>
                        </div>
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Supervisor</label>
                            <div class="textoinfomodal"> {{ $estagio->supervisor }} </div>
                        </div>
                        
                    </div>

                    <div class="modal-footer border-0">
                    </div>
                </div>
            @else
                <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
                <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
            @endcan
        </div>
    </div>
</div>