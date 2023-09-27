<div class="modal" id="modal_legenda_doc" tabindex="-1" aria-labelledby="modal_legenda_doc" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Legenda dos ícones</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <img src="{{ asset('images/information_red.svg') }}" alt="Info estágio"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Informações do estágio</span>
                </div>
                @can('aluno')

                <div class="mb-3">
                    <img src="{{ asset('images/adddiscipline_red.svg') }}" alt="Listar edital"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Preencher documento</span>
                </div>
                <div class="mb-3">
                    <img src="{{ asset('images/pencil_red.svg') }}" alt="Editar estágio"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Editar o documento do estágio</span>
                </div>
                @endcan

                <div class="mb-3">
                    <img src="{{ asset('images/file_red.svg') }}" alt="Listar edital"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Ver documento</span>
                </div>

                @canany(['admin', 'professor', 'servidor', 'gestor'])
                <div class="mb-3">
                    <img src="{{ asset('images/document-checkmark-red.svg') }}" alt="Listar edital"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Aprovar documento</span>
                </div>
                <div class="mb-3">
                    <img src="{{ asset('images/document-dismiss-red.svg') }}" alt="Listar edital"
                        style="height: 30px; width: 30px; padding-bottom: 5px">
                    <span class="textoinfomodal">Negar documento</span>
                </div>
                @endcanany
                {{--  com o documento disabled  --}}
                {{--  <div class="mb-3">
                    <img src="{{ asset('images/listar_edital.svg') }}" alt="Documento Preenchido"
                    style="height: 30px; width: 30px; padding-bottom: 5px; opacity: 50%;" disabled>
                    <span class="textoinfomodal">Documento não foi preenchido</span>
                </div>  --}}

            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>
