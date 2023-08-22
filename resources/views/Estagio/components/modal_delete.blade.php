@canany(['admin', 'servidor'])
  <div class="modal" id="modal_delete_{{$estagio->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-create" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
        <div class="modal-header">
        <h5 class="modal-title title fw-bold " style="color: #131833; font-size: 25px; line-height: 47px;">Deletar Estágio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p style="color: #131833; font-style: normal; font-weight: 400; font-size: 20px; line-height: 47px;">Deseja realmente deletar o estágio?</p>
        </div>

        <div class="modal-footer d-flex justify-content-between">
          <button stype="button" class="btn btn-secondary" style="border-radius: 45px; " data-bs-dismiss="modal">Cancelar</button>

          <form action="{{route('estagio.delete',$estagio->id)}}" method="post">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger" style="border-radius: 45px;">Deletar</button>
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
<div class="modal" id="modal_delete_{{$estagio->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
