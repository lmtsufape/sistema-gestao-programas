<div class="modal fade" id="modal_show_{{$programa->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create">
      <div class="modal-header">

        <h5 style="color: #131833; font-style: normal; font-weight: 600;
        font-size: 30px; line-height: 47px;">{{$programa->nome}}</h5>

        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="mb-3" style="">
                <label for="nome_edit" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
                Nome:</label>

                <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{$programa->nome}}</div>
                @if(!empty($errors->update->first('name')))
                      <span class="invalid-feedback d-block">
                        <strong> {{$errors->update->first('name')}} </strong>
                      </span>
                @endif
              </div>
          <p></p>
          {{--  <a class="btn btn-primary submit-button" data-bs-dismiss="modal" style="width: 200px" role="button">Voltar</a>  --}}
        </div>
    </div>
  </div>
</div>
