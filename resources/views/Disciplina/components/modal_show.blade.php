<div class="modal fade" id="modal_show_{{$disciplina->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create">
      <div class="modal-header">
        <h5 class="modal-title title">{{$disciplina->nome}}</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label">Nome</label>
              <div class="modal-ver">{{$disciplina->nome}}</div>
            </div> 
          </div>
          <p></p>
          <a class="btn btn-primary submit-button" data-bs-dismiss="modal" style="width: 200px" role="button">Voltar</a>
        </div>
    </div>
  </div>
</div>