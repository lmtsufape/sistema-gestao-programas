<div class="modal fade" id="modal_show_{{$disciplina->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #EEEEEE; font-family: 'Roboto', sans-serif;">
      <div class="modal-header" >
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações da Disciplina</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <div class="row mb-3">
            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;">Nome:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #EEEEEE; width: 100%; padding: 5px; box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);">{{$disciplina->nome}}</div>
            
          </div>
        </div>
    </div>
  </div>
</div>