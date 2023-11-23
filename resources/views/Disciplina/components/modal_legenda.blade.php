<div class="modal" id="modal_legenda" tabindex="-1" aria-labelledby="modal_legenda" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Legenda dos ícones</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <img src="{{ asset('images/information_red.svg') }}" alt="Info disciplina"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Informações da disciplina</span>
                </div>
                <div class="mb-3">
                    <img src="{{ asset('images/pencil_red.svg') }}" alt="Editar disciplina"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Editar a disciplina</span>
                </div>
                <div class="mb-3">
                    <img src="{{ asset('images/delete_red.svg') }}" alt="Deletar disciplina"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Deletar a disciplina</span>
                </div>
            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
