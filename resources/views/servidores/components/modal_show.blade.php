@canany(['admin', 'pro_reitor', 'gestor'])
    <div class="modal " id="modal_show_{{ $servidor->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Servidor</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    @if ($servidor->user->image)
                        <img src="/images/fotos-perfil/{{ $servidor->user->image }}" class="img-fluid profilepic mb-3"
                        alt="Foto de perfil">
                    @else
                    <img src="/images/sem-foto-perfil.png" class="img-fluid profilepic mb-3" alt="Foto de perfil">
                    @endif
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">Nome</label>
                        <div class="textoinfomodal">{{ $servidor->user->name }}</div>
                    </div>
                    <div class="mb-3">
                        @if ($servidor->nome_social != null)
                            <label class="tituloinfomodal form-label mt-3">Nome social:</label>
                            <div class="textoinfomodal">{{ $servidor->nome_social }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">CPF</label>
                        <div class="textoinfomodal">{{ $servidor->cpf }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">E-mail</label>
                        <div class="textoinfomodal">{{ $servidor->user->email }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Tipo do servidor:</label>
                        <div class="textoinfomodal">
                            @switch($servidor->tipo_servidor)
                                @case('adm')
                                    <div class="textoinfomodal"> Administrador</div>
                                @break

                                @case('pro_reitor')
                                    <div class="textoinfomodal"> Pró-Reitor</div>
                                @break

                                @case('servidor')
                                    <div class="textoinfomodal"> Servidor</div>
                                @break

                                @case('gestor')
                                    <div class="textoinfomodal"> Diretor</div>
                                @break
                            @endswitch
                        </div>
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
