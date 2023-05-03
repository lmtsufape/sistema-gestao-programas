<div class="modal fade" id="modal_show_" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Programa</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <label for="nome_edit" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">
            Nome:</label>

          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
            
          </div>

          <label for="nome_edit" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">
            Descrição:</label>

          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
            
          </div>
          <!-- @if(!empty($errors->update->first('name')))
          <span class="invalid-feedback d-block">
            <strong> {{$errors->update->first('name')}} </strong>
          </span>
          @endif -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" style="background: #34A853; border: #34A853;" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

