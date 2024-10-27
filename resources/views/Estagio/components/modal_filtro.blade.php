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
                        <div class="col-md-4">
                            <label for="obrigatoriedade">Obrigatoriedade</label>
                            <select class="form-select" aria-label="obrigatoriedade select" name="obrigatoriedade" id="obrigatoriedade">
                                <option value="" {{ request()->obrigatoriedade === null ? 'selected' : '' }}>Todos</option>
                                <option value="1" {{ request()->obrigatoriedade === '1' ? 'selected' : '' }}>Obrigatórios</option>
                                <option value="0" {{ request()->obrigatoriedade === '0' ? 'selected' : '' }}>Não Obrigatórios</option>
                            </select>
                        </div>
                        <div class="col-md-4" style="display: block">
                            <label for="status">status</label>
                            <select class="form-select" aria-label="status select" name="status" id="status">
                                <option value="" {{ request()->status === null ? 'selected' : '' }}>Todos</option>
                                <option value="1" {{ request()->status === '1' ? 'selected' : '' }}>Ativos</option>
                                <option value="0" {{ request()->status === '0' ? 'selected' : '' }}>Inativos</option>
                            </select>
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
