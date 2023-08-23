<div class="modal" id="modal_delete_{{$edital->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
      <h5 class="modal-title title fw-bold " style="color: #131833; font-size: 25px; line-height: 47px;">Deletar Edital</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: #131833; font-style: normal; font-weight: 400; font-size: 20px; line-height: 47px;">Deseja realmente remover o edital?</p>
      </div>

      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Cancelar</button>

        <form action="{{route ('programas.edital-delete', ['id'=> $edital->id])}}" method="delete">

          @csrf
          <button type="submit" class="btn btn-danger">Remover</button>
        </form>
      </div>
  </div>
  </div>
</div>
<style>
    .btn{
      box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.25);
      border-radius: 13px;
      width: 170px;
    }
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
