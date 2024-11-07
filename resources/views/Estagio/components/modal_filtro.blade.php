<style>
    #filter-header {
        color: white;
        background-color: #972E3F;
    }

    #filter-button {
        color: white;
        background-color: #972E3F;
    }

    #filter-button:hover {
        background-color: #852838;
    }

    #modal-frame {
        width: 55%;
        max-width: unset;
    }

    #filterEstagioModal .col-md-4:nth-child(2) {
        display: block;
    }

    #filterEstagioModal ul {
        list-style-type: none;
        padding: 0;
    }

    #filterEstagioModal .card {
        height: 250px;
        overflow-y: auto;
    }
</style>

<div class="modal" id="filterEstagioModal" tabindex="-1" aria-labelledby="filterEstagioModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-frame">
        <div class="modal-content">
            <div class="modal-header" id="filter-header">
                <h3 class="modal-title">Filtrar Estágio</h3>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form action="{{ route('estagio.index') }}" method="get" id="filter-form">
                    <div class="row my-3">
                        <div class="col-md-8">
                            <label for="busca">Busca</label>

                            <input class="form-control" type="text" placeholder="Digite os termos da busca"
                                id="busca" name="busca" value="{{ request()->busca }}">
                        </div>

                        <div class="col-md-4">
                            <label for="orientador">Orientador</label>

                            <select class="form-select form-select-lg" aria-label="orientador select" name="orientador"
                                id="orientador">
                                <option value="" @if (!request()->orientador) selected @endif>Todos</option>
                                @foreach ($orientadores as $orientador)
                                    <option value="{{ $orientador->id }}" @if (request()->orientador == $orientador->id) selected @endif>{{ $orientador->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-4">
                            <label for="obrigatoriedade">Obrigatoriedade</label>

                            <select class="form-select form-select-lg" aria-label="obrigatoriedade select"
                                name="obrigatoriedade" id="obrigatoriedade">
                                <option value="" {{ request()->obrigatoriedade === null ? 'selected' : '' }}>Todos
                                </option>
                                <option value="1" {{ request()->obrigatoriedade === '1' ? 'selected' : '' }}>
                                    Obrigatórios</option>
                                <option value="0" {{ request()->obrigatoriedade === '0' ? 'selected' : '' }}>Não
                                    Obrigatórios</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="status">Status</label>

                            <select class="form-select form-select-lg" aria-label="status select" name="status"
                                id="status">
                                <option value="" {{ request()->status === null ? 'selected' : '' }}>Todos</option>
                                <option value="1" {{ request()->status === '1' ? 'selected' : '' }}>Ativos</option>
                                <option value="0" {{ request()->status === '0' ? 'selected' : '' }}>Inativos
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="aluno">Aluno</label>

                            <select class="form-select form-select-lg" aria-label="aluno select" name="aluno"
                                id="aluno">
                                <option value="" @if (!request()->aluno) selected @endif>Todos</option>
                                @foreach ($alunos as $aluno)
                                    <option value="{{ $aluno->id }}" @if (request()->aluno == $aluno->id) selected @endif>{{ $aluno->nome_aluno }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-4">
                            <label>
                                Cursos
                            </label>

                            <div class="card card-body">
                                <ul>
                                    @foreach ($cursos as $curso)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $curso->id }}" id="curso-{{ $loop->iteration }}"
                                                    name="cursos[]" @if (in_array($curso->id, request()->cursos ?? [])) checked @endif>

                                                <label class="form-check-label" for="curso-{{ $loop->iteration }}">
                                                    {{ $curso->nome }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>
                                Disciplinas
                            </label>

                            <div class="card card-body">
                                <ul>
                                    @foreach ($disciplinas as $disciplina)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $disciplina->nome }}"
                                                    id="disciplina-{{ $loop->iteration }}" name="disciplinas[]"
                                                    @if (in_array($disciplina->nome, request()->disciplinas ?? [])) checked @endif>

                                                <label class="form-check-label"
                                                    for="disciplina-{{ $loop->iteration }}">
                                                    {{ $disciplina->nome }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Período da Data de Solicitação</label>
                            <div class="d-flex">
                                <div class="col-6 pe-2">
                                    <label for="data-inicio-solicitacao">Data de Início</label>

                                    <input class="form-control" type="date" id="data-inicio-solicitacao"
                                        name="data_inicio_solicitacao" value="{{ request()->data_inicio_solicitacao }}">
                                </div>

                                <div class="col-6 ps-2">
                                    <label for="data-fim-solicitacao">Data de Fim</label>
                                    <input class="form-control" type="date" id="data-fim-solicitacao"
                                        name="data_fim_solicitacao" value="{{ request()->data_fim_solicitacao }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="resetarFiltro()">Resetar Filtro</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white">Cancelar</button>
                <button type="submit" form="filter-form" class="btn" id="filter-button">Filtrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function resetarFiltro() {
        $('#filterEstagioModal :input').val('');
        $('#filterEstagioModal input[type="checkbox"]').prop('checked', false);
    }
</script>
