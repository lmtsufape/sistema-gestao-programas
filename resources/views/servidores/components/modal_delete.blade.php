<div class="modal fade" id="modal_delete_{{$servidor->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="{{route("servidores.destroy")}}" method="post">
          @method("DELETE")
          @csrf
          <input type="hidden" name="id" value="{{$servidor->id}}">
          <button type="submit" class="btn btn-danger">Confirmar exclusão</button>
        </form>
      </div>
    </div>
  </div>
</div>
