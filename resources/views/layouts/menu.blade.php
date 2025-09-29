@section('css')
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="../../../css/menu.css">
@endsection

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

@auth
    @hasanyrole(['tecnico_programas', 'tecnico_estagios', 'coordenador_programas', 'coordenador_estagios', 'diretor', 'pro-reitor', 'administrador'])
        <header>
            <!-- Isso aqui é a barra de cima -->
            <nav class="navbar navbar-menu d-flex">
                <div class="container-fluid d-flex fonteheader">
                    <div class="botoesdd">
                        <div class="dropdown">
                            <button class="btn-menu" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <img src="{{ asset('images/list-box-outline.png') }}" alt="listar" class="image-size">
                                Listar
                                <span><img src="{{ asset('images/arrow-3.png') }}" alt="mostrar" class="arrow-dd"></span>
                            </button>
                            <ul class="dropdown-menu menu" role="menu"
                                aria-labelledby="dropdownMenuButton">
                                @can('listar programa')
                                    <li><a class="dropdown-item" href="{{ route('programas.index') }}">Programas</a></li>
                                @endcan
                                @can('listar servidor')
                                    <li><a class="dropdown-item" href="{{ route('servidores.index') }}">Servidores</a></li>
                                @endcan
                                @can('listar estudante')
                                    <li><a class="dropdown-item" href="{{ route('alunos.index') }}">Discentes</a></li>
                                @endcan
                                @can('listar orientador')
                                    <li><a class="dropdown-item" href="{{ route('orientadors.index') }}">Docentes</a></li>
                                @endcan
                                @can('listar curso')
                                    <li><a class="dropdown-item" href="{{ route('cursos.index') }}">Cursos</a></li>
                                @endcan
                                @can('listar disciplina')
                                    <li><a class="dropdown-item" href="{{ route('disciplinas.index') }}">Disciplinas</a></li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                    <div class="botoesdd">
                        <div class="dropdown">
                            <button class="btn-menu" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <img src="{{ asset('images/folder-outline.png') }}" alt="gerenciar" class="image-size">
                                Gerenciar
                                <span><img src="{{ asset('images/arrow-3.png') }}" alt="mostrar" class="arrow-dd"></span>
                            </button>
                            <ul class="dropdown-menu menu"role="menu" aria-labelledby="dropdownMenuButton">
                                @can('listar edital')
                                    <li><a class="dropdown-item" href="{{ route('edital.index') }}">Editais</a></li>
                                @endcan
                                @unlessrole(['pro-reitor', 'diretor'])
                                    <li><a class="dropdown-item" href="{{ route('cursos.index') }}">Cursos</a></li>
                                    <li><a class="dropdown-item" href="{{ route('disciplinas.index') }}">Disciplinas</a></li>
                                @endunless
                                @can('listar estagio')
                                    <li><a class="dropdown-item" href="{{ route('estagio.index') }}">Estágio</a></li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                    @role('administrador')
                        <div class="botoesdd">
                            <div class="dropdown">
                                <button class="btn-menu " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                    <img src="{{ asset('images/plus.png') }}" alt="cadastrar" class="image-size">
                                    Cadastrar
                                    <span><img src="{{ asset('images/arrow-3.png') }}" alt="mostrar"
                                            class="arrow-dd"></span>
                                </button>
                                <ul class="dropdown-menu menu"role="menu"
                                    aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ url('/edital/create') }}">Editais</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/cursos/create') }}">Cursos</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/disciplinas/create') }}">Disciplinas</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('/programas/create') }}">Programas</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="botoesdd">
                            <div class="dropdown">
                                <button class="btn-menu " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                    <img src="{{ asset('images/list-box-outline.png') }}" alt="listar" class="image-size">
                                    Relatórios
                                    <span><img src="{{ asset('images/arrow-3.png') }}" alt="mostrar"
                                            class="arrow-dd"></span>
                                </button>
                                <ul class="dropdown-menu menu"role="menu"
                                    aria-labelledby="dropdownMenuButton" style="width: 290px">
                                    <li><a class="dropdown-item" href="{{route('relatorios')}}">Ver informações</a></li>
                                    <li><a class="dropdown-item" href="#">Listar docentes por edital</a></li>
                                    <li><a class="dropdown-item" href="#">Listar docentes por discentes</a></li>
                                    <li><a class="dropdown-item" href="#">Listar edital com docentes e discentes</a></li>
                                </ul>
                            </div>
                        </div>
                    @endrole
                </div>
            </nav>
        </header>
    @endhasanyrole
@endauth
