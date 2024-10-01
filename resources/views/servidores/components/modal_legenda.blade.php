<div class="modal" id="modal_legenda" tabindex="-1" aria-labelledby="modal_legenda" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Legenda dos ícones</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <img src="{{ asset('images/information_red.svg') }}" alt="Info servidor"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Informações do servidor</span>
                </div>
                @can('editar servidor')
                    <div class="mb-3">
                        <img src="{{ asset('images/pencil_red.svg') }}" alt="Editar servidor"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Editar o servidor</span>
                    </div>
                @endcan
                @can('deletar servidor')
                    <div class="mb-3">
                        <img src="{{ asset('images/delete_red.svg') }}" alt="Deletar servidor"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Deletar o servidor</span>
                    </div>
                @endcan
            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
