@canany(['admin', 'servidor'])
    <div class="modal" id="modal_delete_{{ $disciplina->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content fundomodaldelete">
                <div class="modal-header border-0">
                </div>
                <div class="modal-body">
                    <p class="titulomodal">Deseja realmente remover a disciplina {{ $disciplina->nome }}?</p>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button stype="button" class="cancelarmodalbotao" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ url('/disciplinas/>1') }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{ $disciplina->id }}">
                        <button type="submit" class="apagarmodalbotao">Remover</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="modal" id="modal_delete_{{ $disciplina->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
                <div class="modal-header">
                    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
                    <a class="apagarmodalbotao" data-bs-dismiss="modal" style="margin-top: 1rem">Fechar</a>

                </div>
            </div>
        </div>
    </div>
@endcan
