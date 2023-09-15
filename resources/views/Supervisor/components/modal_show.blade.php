@canany(['admin', 'pro_reitor', 'gestor'])
    <div class="modal " id="modal_show_{{ $supervisor->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Supervisor</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">Nome</label>
                        <div class="textoinfomodal">{{ $supervisor->nome }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">CPF</label>
                        <div class="textoinfomodal">{{ $supervisor->cpf }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">E-mail</label>
                        <div class="textoinfomodal">{{ $supervisor->email }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Telefone:</label>
                        <div class="textoinfomodal">{{ $supervisor->telefone }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Formação:</label>
                        <div class="textoinfomodal">{{ $supervisor->formacao }}</div>
                        <div class="modal-footer border-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .btn {
                color: #fff;
                background: #34A853;
                border-color: #34A853;
                border-radius: 20px;
                width: 120px;
            }

            .btn:hover {
                background-color: #40b760;
                border-color: #40b760;
                color: #fff;
            }
        </style>
        @elsecan
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/home') }}">Voltar</a>
    @endcan
