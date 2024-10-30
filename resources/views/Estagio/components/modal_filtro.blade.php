<style>
    #filter-header {
        color: white;
        background-color: #972E3F;
    }

    #filter-button {
        color: white;
        background-color: #972E3F;
    }

    #modal-frame {
        width: 70%;
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
        max-height: 250px;
        overflow-y: auto;
    }
</style>

<div class="modal" id="filterEstagioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modal-frame">
        <div class="modal-content">
            <div class="modal-header" id="filter-header">
                <h3 class="modal-title" id="exampleModalLabel">Filtrar Estágio</h3>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form action="{{ route('estagio.index') }}" method="get" id="filterForm">
                    <div class="row my-3">
                        <div class="col-md-8">
                            <label for="busca">Busca</label>

                            <input class="form-control" type="text" placeholder="Digite os termos da busca"
                                id="busca" name="busca" style="text-align: start">
                        </div>

                        <div class="col-md-4">
                            <label>Data de Solicitação</label>
                            <div class="d-flex">
                                <div class="col-6 pe-2">
                                    <label for="data-inicio-solicitacao">Data Início:</label>

                                    <input class="form-control" type="date" id="data-inicio-solicitacao"
                                        name="data_inicio_solicitacao" value="{{ request()->data_inicio_solicitacao }}">
                                </div>

                                <div class="col-6 ps-2">
                                    <label for="data-fim-solicitacao">Data Fim:</label>
                                    <input class="form-control" type="date" id="data-fim-solicitacao"
                                        name="data_fim_solicitacao" value="{{ request()->data_fim_solicitacao }}">
                                </div>
                            </div>
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="filterForm" class="btn" id="filter-button">Filtrar</button>
            </div>
        </div>
    </div>
</div>
