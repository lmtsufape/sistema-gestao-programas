@canany(['admin', 'servidor'])
  <div class="modal" id="modal_delete_{{$edital->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content fundomodaldelete">
            <div class="modal-header border-0">
            </div>
            <div class="modal-body" style="text-align: start">
                <p class="titulomodal">Deseja realmente remover o edital?</p>
        </div>

        <div class="modal-footer d-flex justify-content-between border-0">
            <button stype="button" class="cancelarmodalbotao" data-bs-dismiss="modal">Cancelar</button>

          <form action="{{route('edital.delete',$edital->id)}}" method="post">
            @method("DELETE")
            @csrf
            <button type="submit" class="apagarmodalbotao">Remover</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@else
<div class="modal" id="modal_delete_{{$edital->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
            <div class="modal-header">
                <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
                <button stype="button" class="cancelarmodalbotao" data-bs-dismiss="modal">Fechar</a>

            </div>
        </div>
    </div>
</div>
@endcan
