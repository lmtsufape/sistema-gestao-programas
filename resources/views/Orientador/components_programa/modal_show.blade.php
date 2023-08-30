<div class="modal" id="modal_show_" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Informações do Programa</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Nome</label>

                    <div class="textoinfomodal">

                    </div>

                    <label class="tituloinfomodal form-label mt-3">Descrição</label>
                    <div class="textoinfomodal">
                    </div>
                    <!-- @if (!empty($errors->update->first('name')))
<span class="invalid-feedback d-block">
            <strong> {{ $errors->update->first('name') }} </strong>
          </span>
@endif -->
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" style="background: #34A853; border: #34A853;" class="btn btn-secondary"
                    data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
