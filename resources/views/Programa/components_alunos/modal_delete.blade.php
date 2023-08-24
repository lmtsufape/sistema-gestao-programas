<div class="modal" id="modal_delete_" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
        <div class="modal-header">
          <h5 class="modal-title title fw-bold " style="color: #131833; font-size: 25px; line-height: 47px;">Deletar Aluno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="text-align: start">
          <p style="color: #131833; font-style: normal; font-weight: 400; font-size: 20px; line-height: 47px;">
            Deseja realmente remover o aluno?</p>
        </div>
        <div class="modal-footer d-flex justify-content-between border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form action="" method="post">
            @method("DELETE")
            @csrf
            <input type="hidden" name="id" value="">
            <button type="submit" class="btn btn-danger">Remover</button>
          </form>
        </div>
      </div>
    </div>
  </div>
