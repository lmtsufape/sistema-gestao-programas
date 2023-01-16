<div class="modal fade" id="modal_show_{{$programa->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #EEEEEE; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Programa</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row mb-3">
                <label for="nome_edit" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">
                Nome:</label>

                <div style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{$programa->nome}}</div>
                @if(!empty($errors->update->first('name')))
                      <span class="invalid-feedback d-block">
                        <strong> {{$errors->update->first('name')}} </strong>
                      </span>
                @endif
              </div>
        </div>
    </div>
  </div>
</div>
