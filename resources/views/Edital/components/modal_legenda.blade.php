<div class="modal" id="modal_legenda" tabindex="-1" aria-labelledby="modal_legenda" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Legenda dos ícones</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <img src="{{ asset('images/information_red.svg') }}" alt="Info aluno"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Informações do edital</span>
                </div>
                @cannot('pro_reitor')
                    <div class="mb-3">
                        <img src="{{ asset('images/link-variant_red.svg') }}" alt="Vincular aluno"
                            style=" width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Vincular estudante ao edital</span>
                    </div>
                @endcannot
                <div class="mb-3">
                    <img src="{{ asset('images/account-check_red.svg') }}" alt="Listar aluno"
                        style=" width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Listar estudantes vinculados ao edital</span>
                </div>
                @cannot('pro_reitor')
                    <div class="mb-3">
                        <img src="{{ asset('images/account-remove_red.svg') }}" alt="Listar aluno"
                            style=" width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Listar estudantes vinculados inativos ao edital</span>
                    </div>
                @endcannot
                <div class="mb-3">
                    <img src="{{ asset('images/card-account-details_red.svg') }}" alt="Listar orientadores"
                        style=" width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Listar orientadores vinculados ao edital</span>
                </div>
                @cannot('pro_reitor')
                    <div class="mb-3">
                        <img src="{{ asset('images/pencil_red.svg') }}" alt="Editar aluno"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Editar o edital</span>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('images/delete_red.svg') }}" alt="Deletar aluno"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Deletar o edital</span>
                    </div>
                @endcannot
            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
