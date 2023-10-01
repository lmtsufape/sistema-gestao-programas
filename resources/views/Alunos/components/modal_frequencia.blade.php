<!-- Modal -->
<div class="modal " tabindex="-1" aria-hidden="true" id="modal_frequencia">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Documentos do Estudante</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ Route('frequencia.enviar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="text-align: start">
                    <label>Frequência Mensal</label>
                    <input class="w-75 form-control" type="file" name="frequencia_mensal" id="frequencia_mensal" title="Envie sua frequencia" required>
                </div>
                <input type="hidden" name="edital_id" value="{{$edital->id}}">

                <div class="modal-footer border-0 mb-3">
                    <button type="submit" class="botaosalvar">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>