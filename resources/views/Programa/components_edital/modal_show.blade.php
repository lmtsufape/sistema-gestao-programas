<div class="modal " id="modal_show_{{ $edital->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Informações do Edital</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Data de início</label>
                    <div class="textoinfomodal"> {{ date_format(date_create($edital->data_inicio), 'd/m/Y') }}</div>
                </div>
                <div class="mb-3">

                    <label class="tituloinfomodal form-label mt-3">Data de fim</label>
                    <div class="textoinfomodal"> {{ date_format(date_create($edital->data_fim), 'd/m/Y') }}</div>
                </div>
                <div class="mb-3">

                    <label class="tituloinfomodal form-label mt-3">Programa</label>
                    <div class="textoinfomodal">{{ $edital->programa->nome }}</div>
                </div>
            </div>
            <div class="modal-footer border-0">
            </div>
        </div>
    </div>
</div>
</div>
