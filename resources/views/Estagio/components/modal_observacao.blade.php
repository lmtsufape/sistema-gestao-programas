@foreach ($documentos as $documento)
    <div class="modal" id="modal_observacao_{{ $lista_documento->documento_id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Observação</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </form>
                </div>
                <div class="modal-body" style="text-align: start">
                    <div class="mb-3">
                        {{--  @if (empty($lista_documento->observacao))
                    <p >Sem observação</p>
                    @else
                    <p >{{$lista_documento->observacao}}</p>
                    @endif  --}}

                        @if (!empty(trim($lista_documento->observacao)))
                            <p>{{ $lista_documento->observacao }}</p>
                        @else
                            <p>Sem observação</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
