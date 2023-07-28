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
    <div>
      <nav class="navbar navbar-expand-lg fundoheader">
          <div class="container-fluid">
            <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
              @auth
                <a href="{{route('home')}}" type="button" >
                  <img src="{{asset("images/Logo-SGPA.svg")}}" alt="Logo da SGPA" style="height: auto; width: auto">
                </a>
              @else
                  <a href="{{url('/')}}" type="button">
                      <img src="{{asset("images/Logo-SGPA.svg")}}" alt="Logo da SGPA">
                  </a>
              @endauth
            </ul>

            <div>
                <div style="text-align: right; display:flex">
                    @auth
                    <button class="botaoinvisivel" type="button" >
                        <img src="../../images/sininho.svg" alt="Notificações" style="height: auto; width: auto">
                    </button>

                    <img src="../../images/sem-foto-perfil.svg"  class="img-fluid fotouser" alt="Foto de perfil">
                    @endauth

                    <h2 class="fonteheader">
                        @auth
                            Olá, {{Auth::user()->name}}
                        @endauth
                    </h2>

                    @auth
                    <div class="dropdown"  style="margin-top: 10px">
                        <button class="botaoinvisivel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="../../images/arrowdown.svg" alt="Seta para baixo" style="height: auto; width: auto">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if (auth()->user()->typage_type == "App\Models\Servidor")
                            <a href="{{route('meu-perfil-servidor')}}" class="fonteheader" style="padding-left: 5%" href="#">Meu perfil</a>
                            @endif
                            @if (auth()->user()->typage_type == "App\Models\Orientador")
                            <a href="{{route('meu-perfil-orientador')}}" class="fonteheader" style="padding-left: 5%" href="#">Meu perfil</a>
                            @endif
                            @if (auth()->user()->typage_type == "App\Models\Aluno")
                            <a href="{{route('meu-perfil-aluno')}}" class="fonteheader" style="padding-left: 5%" href="#">Meu perfil</a>
                            @endif
                            <form action="/logout" method="POST" style="padding-left: 5%">
                                @csrf
                                <a href="/logout"  onclick="event.preventDefault(); this.closest('form').submit()" class="link_navbar">
                                <p class="fonteheader"> Sair </p>
                                </a>
                            </form>
                        </div>
                    </div>
                    @endauth


                    @auth

                </div>
              @else
              <div style="text-align: right;">
                <a href="/" class="fonteheader">Início</a>
                <a href="/sistema" class="fonteheader">O Sistema</a>
                <a href="/parceria" class="fonteheader">A Parceria</a>
                <a href="/contato" class="fonteheader">Contato</a>
              </ul>

              @endauth
            </div>
          </div>
        </nav>
    </div>
  </header>

