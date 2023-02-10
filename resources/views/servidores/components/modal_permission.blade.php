<div class="modal fade " id="modal_permission_{{$servidor->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #EEEEEE; font-family: 'Roboto', sans-serif;">
        <div class="modal-header" >
          <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Servidor</h5>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <div class="row mb-3">
                <label for="permissoes" class="titulo">Permissões do servidor:</label>

            <select name="servidores[]" id="permissoes" multiple>
                <option value=""></option>
                {{--  @foreach
                    <option value="{{}}" {{in_array() ? 'selected' : ''}}
                    style="color: black; border-radius: 5px;"> {{}} </option>
                @endforeach  --}}
            </select>
            </div>

          </div>
      </div>
    </div>
  </div>
  <style>
    .btn-secondary{
      color: #fff;
      background-color: #2d3875;
      border-color: #2d3875;
    }
    .btn-secondary:hover{
      background-color: #4353ab;
      border-color: #4353ab;
    }
    .titulo {
        font-weight: 600;
        font-size: 20px;
        line-height: 28px;
        display: flex;
        color: #131833;
    }
  </style>
