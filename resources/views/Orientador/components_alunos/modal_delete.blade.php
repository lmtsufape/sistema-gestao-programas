@can('desvincular estudante-edital')
    <div class="modal" id="modal_delete{{ $pivo->aluno_id }}_{{ $pivo->edtial_id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content fundomodaldelete">
                <div class="modal-header border-0">
                </div>
                <div class="modal-body" style="text-align: start">
                    <p class="titulomodal">Deseja realmente remover o discente {{$pivo->aluno->nome_aluno}}?</p>
                </div>
                <div class="modal-footer d-flex justify-content-between border-0">
                    <button type="button" class="cancelarmodalbotao" data-bs-dismiss="modal">Cancelar</button>

                    <form
                        action="{{ route('edital.aluno.delete', ['id' => $pivo->edital_id]) }}"
                        method="GET">

                        @csrf
                        <button type="submit" class="apagarmodalbotao">Remover</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="modal" id="modal_delete_{{ $pivo->aluno_id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
                <div class="modal-header">
                    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
                    <a class="btn btn-primary submit" data-bs-dismiss="modal" style="margin-top: 1rem">Fechar</a>
                </div>
            </div>
        </div>
    </div>
@endcan