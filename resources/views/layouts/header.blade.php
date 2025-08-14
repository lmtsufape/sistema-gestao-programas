@section('css')
<link rel="stylesheet" href="/css/app.css">
<link rel="stylesheet" href="/css/header.css">
@endsection

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<header>
    <!-- Isso aqui é a barra de cima -->
    <nav class="navbar navbar-expand-lg fundoheader">
        <div class="container-fluid">
            <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                <a href="{{route('home')}}" type="button" style="margin-left: 5em">
                    <img src="{{asset("images/Logo-SGPA.svg")}}" alt="Logo da SGPA" style="margin-top: 5px; height: 75px; width: 245px">
                </a>
            </ul>

            <div>
                @auth
                    <div class="d-lg-flex justify-content-end align-items-center">
                        <livewire:notification-bell />
                        <img src="{{ Auth::user()->image
                            ? asset('images/fotos-perfil/' . Auth::user()->image)
                            : asset('images/sem-foto-perfil.svg') }}"
                            title="Minha foto de perfil"
                            class="img-fluid fotoUserAuth"
                            alt="Foto de perfil">
                        <div class="dropdown" style="margin-top: 10px;">
                            <button class="botaoinvisivel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fonteheader">Olá, {{Auth::user()->name}}</span>
                                <img src="{{ asset('images/arrowdown.svg') }}" title="Opções do meu perfil" alt="Seta para baixo" style="height: auto; width: auto">

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding: 15px;">
                                @hasanyrole(['tecnico_estagios', 'tecnico_programas'])
                                    {{-- a com icon de UserVector  --}}
                                    <a href="{{ route('meu-perfil-servidor') }}" class="caixinhasetinha">
                                        <img src="{{ asset('images/UserVector.svg') }}" alt="Icone de usuário">
                                        <span style="margin-left: 5px;">Meu perfil</span>
                                    </a>
                                @endhasanyrole
                                @role('orientador')
                                    <a href="{{ route('meu-perfil-orientador') }}" class="caixinhasetinha">
                                        <img src="{{ asset('images/UserVector.svg') }}" alt="Icone de usuário">
                                        <span style="margin-left: 5px;">Meu perfil</span>
                                    </a>
                                @endrole
                                @role('estudante')
                                    <a href="{{ route('meu-perfil-aluno') }}" class="caixinhasetinha">
                                        <img src="{{ asset('images/UserVector.svg') }}" alt="Icone de usuário">
                                        <span style="margin-left: 5px;">Meu perfil</span>
                                    </a>
                                @endrole
                                <form action="/logout" method="POST">
                                    @csrf
                                    <div style="padding-top: 10px">
                                        <a href="/logout" class="caixinhasetinha" onclick="event.preventDefault(); this.closest('form').submit()" class="link_navbar">
                                            <img src="{{ asset('images/logoutVector.svg') }}" alt="Sai da conta">
                                            <span style="margin-left: 5px;"> Sair </span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                @else
                    <div style="text-align: right;">
                        <a href="/" class="fonteheader">Início</a>
                        <a href="/sistema" class="fonteheader">O Sistema</a>
                        <a href="/parceria" class="fonteheader">A Parceria</a>
                        <a href="/contato" class="fonteheader">Contato</a>
                        </ul>
                    </div>
                @endauth
            </div>
    </nav>
</header>
