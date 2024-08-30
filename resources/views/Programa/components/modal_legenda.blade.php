<div class="modal" id="modal_legenda" tabindex="-1" aria-labelledby="modal_legenda" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Legenda dos ícones</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <img src="{{ asset('images/information_red.svg') }}" alt="Info programa"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Informações do programa</span>
                </div>
                @cannot(['pro_reitor', 'gestor'])
                    <div class="mb-3">
                        <img src="{{ asset('images/account-plus_red.svg') }}" alt="Atribuir servidor"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Atribuir servidor ao programa</span>
                    </div>
                @endcannot
                <div class="mb-3">
                    <img src="{{ asset('images/file_red.svg') }}" alt="Listar edital"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Listar editais do programa</span>
                </div>
                @cannot(['pro_reitor', 'gestor'])
                    <div class="mb-3">
                        <img src="{{ asset('images/file-plus_red.svg') }}" alt="Add edital"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Adicionar edital do programa</span>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('images/pencil_red.svg') }}" alt="Editar programa"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Editar o programa</span>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('images/delete_red.svg') }}" alt="Deletar programa"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Deletar o programa</span>
                    </div>
                @endcannot
            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
