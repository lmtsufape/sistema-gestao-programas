@canany(['admin', 'servidor'])
  <div class="modal" id="modal_delete_{{$orientador->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
        <div class="modal-header">
          <h5 class="modal-title title fw-bold " style="color: #131833; font-size: 25px; line-height: 47px;" id="exampleModalLabel">Deletar Orientador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p style="color: #131833; font-style: normal; font-weight: 400; font-size: 20px; line-height: 47px;">Deseja realmente remover o orientador {{$orientador->user->name}} ?</p>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button stype="button" class="btn btn-secondary" style="border-radius: 45px; " data-bs-dismiss="modal">Cancelar</button>
          <form action="{{route ('orientadors.delete', ['id'=> $orientador->id])}}" method="post">
            @method("DELETE")
            @csrf
            <input type="hidden" name="id" value="{{$orientador->id}}">
            <button type="submit" class="btn btn-danger" style="border-radius: 45px;">Remover</button>
          </form>
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
<div class="modal" id="modal_delete_{{$orientador->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
