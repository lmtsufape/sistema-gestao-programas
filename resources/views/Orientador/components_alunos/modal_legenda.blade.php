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
                    <span class="textoinfomodal">Informações do discente</span>
                </div>

                <div class="mb-3">
                    <img src="{{ asset('images/adddiscipline_red.svg') }}" alt="Adicionar documentos"
                         style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Adicionar documentos</span>
                </div>

                @can('editar estudante')
                    <div class="mb-3">
                        <img src="{{ asset('images/pencil_red.svg') }}" alt="Editar aluno"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Editar o discente</span>
                    </div>
                @endcan
                @can('desvincular estudante-edital')
                    <div class="mb-3">
                        <img src="{{ asset('images/Unlink_red.svg') }}" alt="Desvincular aluno"
                            style="height: 30px; width: 30px; padding-bottom: 5px">
                        <span class="textoinfomodal">Desvincular o discente</span>
                    </div>
                @endcan
                <div class="mb-3">
                    <img src="{{ asset('images/file_red.svg') }}" alt="Docs aluno"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Documentos do discente</span>
                </div>

            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
