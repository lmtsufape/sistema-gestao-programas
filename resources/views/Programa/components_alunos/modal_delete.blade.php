<div class="modal" id="modal_delete_" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content fundomodaldelete">
            <div class="modal-header border-0">
            </div>
            <div class="modal-body" style="text-align: start">
                <p class="titulomodal">Deseja realmente remover o discente?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-between border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id" value="">
                    <button type="submit" class="apagarmodalbotao">Remover</button>
                </form>
            </div>
        </div>
    </div>
</div>
