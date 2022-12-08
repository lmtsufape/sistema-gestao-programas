<div class="modal fade" id="modal_delete_{{$orientador->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;">Confirmação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 20px; line-height: 47px;">
          Deseja realmente deletar o orientador {{$orientador->nome}}?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="{{url("/orientadors/1")}}" method="post">
          @method("DELETE")
          @csrf
          <input type="hidden" name="id" value="{{$orientador->id}}">
          <button type="submit" class="btn btn-danger">Confirmar exclusão</button>
        </form>
      </div>
    </div>
  </div>
</div>
