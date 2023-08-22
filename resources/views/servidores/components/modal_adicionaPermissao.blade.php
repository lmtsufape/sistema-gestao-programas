@canany(['admin', 'pro_reitor'])
  <div class="modal" id="modal_adicionaPermissao_{{$servidor->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
      <h5 class="modal-title title fw-bold " style="color: #131833; font-size: 25px; line-height: 47px;">Adicionar permissão ao servidor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url("/servidores/permissao/$servidor->id")}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$servidor->id}}">
            <label for="permissao" class="mb-2" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Permissão: </label>
            <select name="permissao" id="permissao" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" aria-label="Default select example">
                <option value=""></option>
                @foreach ($permissoes as $permissao)
                    <option value="{{$permissao->name}}">{{$permissao->name}}</option>
                @endforeach
            </select>


        <button stype="button" class="btn btn-primary" style="border-radius: 45px; margin-top: 15px; margin-right: 10px " data-bs-dismiss="modal">Salvar</button>

        </form>

        <button stype="button" class="btn btn-secondary" style="border-radius: 45px; margin-top: 15px; margin-left: 10px  " data-bs-dismiss="modal">Cancelar</button>

      </div>

      <div class="modal-footer d-flex justify-content-between">

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
  </style>
@else
<div class="modal" id="modal_delete_{{$servidor->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
            <div class="modal-header">
                <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
                <a class="btn btn-primary submit" data-bs-dismiss="modal" style="margin-top: 1rem" >Fechar</a>

            </div>
        </div>
    </div>
</div>
@endcan
