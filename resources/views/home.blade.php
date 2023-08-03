@extends("templates.app")
@section('css')
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="../../../css/home.css">
@endsection
@section("body")

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
