@canany(['admin', 'pro_reitor'])
  <div class="modal fade" id="modal_delete_{{$programa->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius: 15px; background-color: #F2F2F2; font-family: 'Roboto', sans-serif;">
        <div class="modal-header">
          <h5 class="modal-title title fw-bold " style="color: #131833; font-size: 25px; line-height: 47px;">Deletar Programa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p style="color: #131833; font-style: normal; font-weight: 400; font-size: 20px; line-height: 47px;">
            Deseja realmente deletar o programa {{$programa->nome}}?</p>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form action="{{url("/programas/>1")}}" method="post">
            @method("DELETE")
            @csrf
            <input type="hidden" name="id" value="{{$programa->id}}">
            <button type="submit" class="btn btn-danger">Deletar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
