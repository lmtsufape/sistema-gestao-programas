@can('visualizar servidor')
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
                            @foreach($servidor->user->roles as $key => $role)
                                @switch($role->name)
                                    @case('administrador')
                                        <div class="textoinfomodal"> Administrador
                                    @break
                            
                                    @case('pro-reitor')
                                        <div class="textoinfomodal"> Pró-Reitor
                                    @break
                            
                                    @case('tecnico')
                                        <div class="textoinfomodal"> Técnico Administrativo
                                    @break
                            
                                    @case('diretor')
                                        <div class="textoinfomodal"> Diretor
                                    @break

                                    @case('coordenador')
                                        <div class="textoinfomodal"> Coordenador
                                    @break

                                    @case('supervisor')
                                        <div class="textoinfomodal"> Supervisor
                                    @break
                                @endswitch
                            @endforeach
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
