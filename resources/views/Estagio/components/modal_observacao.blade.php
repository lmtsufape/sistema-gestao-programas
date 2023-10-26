@foreach ($documentos as $documento)
<div class="modal" id="modal_observacao_{{$lista_documento->documento_id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Observação</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </form>
        </div>
        <div class="modal-body" style="text-align: start">
            <div class="mb-3">
                    <label class="input-informacao" for="">Observação</label>
                    @if (empty($documento->observacao))
                    <p class="output-informacao">Sem observação</p>
                    @else
                    <p class="output-informacao">{{$lista_documento->observacao}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach