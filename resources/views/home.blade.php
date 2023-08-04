@extends("templates.app")

@section("body")

<style>
    .botao {
      border: none;
      color: white;
      font-style: normal;
      font-weight: 700;
      font-size: 20px;
      line-height: 23px;
      text-align: center;
      width: 250px;
      height: 123px;
      left: 193px;
      top: 249px;
      display: flex;
      align-items: center;
      padding-left: 20px;
      min-width: 250px;
      background: #FFF3F4;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      margin-bottom: 30px;
      border-radius: 20px;
    }

    .botao:hover{
        transform: scale(1.08);
    }


    .container {
        min-height: calc(85vh - 100px); /* Subtract the footer height from the viewport height */
        display: flex;
        flex-direction: column;
      }

    .title {
        font-style: normal; 
        padding-top: 38px;
        font-weight: 700; 
        text-align:start ;
        font-size: 35px; 
        line-height: 41px; 
        color: #131833;
    }

    .second-title {
        font-style: normal; 
        padding-top: 38px;
        font-weight: 700;
        text-align:center;
        font-size: 35px; 
        line-height: 41px; 
        color: #590B10;
    }

    .third-title {
        margin: auto; 
        padding-right: 5px;
        color: #972E3F;
    }

    .buttons-organization {
        display:flex; 
        flex-wrap:wrap; 
        align-items:center; 

    }

    .buttons-organization.-orientador {
        gap:5%;
    }

    .buttons-organization.-aluno {
        gap:5%;
    }

    .buttons-organization.-gestor{
        gap: 4%;
        justify-content: flex-start;
    }

    .buttons-organization.-adm{
        gap:4%;
    }
  </style>
    @auth
        @if (auth()->user()->typage_type == "App\Models\Servidor")

            <div class="container">
                
                {{--  condição para se for admin aparacer a opão de Cadastrar programa  --}}

                @if (auth()->user()->typage->tipo_servidor == 'adm')

                <h2 class="second-title">
                    Ações
                </h2>
                <hr>
                <br>

                <div class="buttons-organization -adm">
                    <div class="buttons-organization -adm">
                        <button class="botao" ref="{{url("/programas/create")}}" onclick="window.location.href='{{url("/programas/create")}}'">
                            <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 10px;">
                            <p class="third-title"> Cadastrar programa </p>
                        </button>
                    </div>

                    {{--  Cadastrar edital  --}}
                    <div class="buttons-organization -adm">
                        <button class="botao" ref="{{url("/editais/create")}}" onclick="window.location.href='{{route("edital.create")}}'">
                            <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 10px;">
                            <p class="third-title"> Cadastrar <br> edital </p>
                        </button>
                    </div>

                    {{--  Cadastrar disciplina  --}}
                    <div class="buttons-organization -adm">
                        <button class="botao" ref="{{url("/disciplinas/create")}}" onclick="window.location.href='{{url("/disciplinas/create")}}'">
                            <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 10px;">
                            <p class="third-title"> Cadastrar disciplina </p>
                        </button>
                    </div>

                    {{--  Cadastrar curso  --}}
                    <div class="buttons-organization -adm">
                        <button class="botao" ref="{{url("/cursos/create")}}" onclick="window.location.href='{{url("/cursos/create")}}'">
                            <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 10px;">
                            <p class="third-title"> Cadastrar <br> curso </p>
                        </button>
                    </div>
                </div>
                @endif
                @if (auth()->user()->typage->tipo_servidor == 'gestor')

                @endif
                <h2 class="second-title">
                    Programas
                </h2>
                <hr>
                <br>
                <div class= "buttons-organization -gestor">
                    @foreach ($programas as $index => $programa)
                      @if ($index % 2 == 0)
                        <button class="botao" href="{{url("/programas/".$programa->id."/editais")}}" onclick="window.location.href='{{url("/programas/".$programa->id."/editais")}}'">
                      @else
                        <button class="botao" href="{{url("/programas/".$programa->id."/editais")}}" onclick="window.location.href='{{url("/programas/".$programa->id."/editais")}}'">
                      @endif
                      <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 10px;">
                      <p class="third-title">{{ $programa->nome }}</p>
                      </button>
                    @endforeach
                </div>
                <br>
            </div>

        @endif



    @endauth

    @auth
        @if (auth()->user()->typage_type == "App\Models\Aluno")

        <div class="container">
            <h2 class="second-title">
                    Programas
                </h2>
                <hr>
                <br>

            <div class="buttons-organization -aluno">
                <button class="botao" ref="{{url("/listar-modelos")}}" onclick="window.location.href='{{url("/listar-modelos")}}'">
                    <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 10px;">
                    <p class="third-title"> Listar modelos de documentos </p>
                </button>

                <button class="botao" ref="{{url('/editais-aluno')}}" onclick="window.location.href='{{url('/editais-aluno')}}'">
                    <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 10px;">
                    <p class="third-title"> Ver meus editais </p>
                </button>

            </div>
        </div>

        @endif
    @endauth

    @auth
        @if (auth()->user()->typage_type == "App\Models\Orientador")

        <div class="container">
            <h2 class="second-title">
                Programas
            </h2>
            <hr>
            <br>

            <div class="buttons-organization -orientador">
                <button class="botao" href="{{url('/listar_alunos-orientador')}}" onclick="window.location.href='{{url('/listar_alunos-orientador')}}'">
                    <img src="{{asset("images/list-box.svg")}}" alt="user" style="padding-right: 20px;">
                    <p class="third-title">Listar alunos </p>
                </button>

                <button class="botao" href="{{url('/editais-orientador')}}" onclick="window.location.href='{{url('/editais-orientador')}}'">
                    <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 20px;">
                    <p class="third-title"> Meus editais </p>
                </button>

                <button class="botao" href="{{url("/listar-modelos")}}" onclick="window.location.href='{{url("/listar-modelos")}}'">
                    <img src="{{asset("images/list-box.svg")}}" alt="logodoc" style="padding-right: 20px;">
                    <p class="third-title">   Listar modelos de documentos </p>

                </button>
            </div>
            <br>
        </div>
        @endif
    @endauth

@endsection
