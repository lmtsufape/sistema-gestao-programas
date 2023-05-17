@extends("templates.app")

@section("body")

<style>
    .botaoverde {
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
      min-width: 270px;
      background: #34A853;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      margin-bottom: 30px;
      border-radius: 20px;
    }

    .botaoazul {
      border: none;
      color: white;
      font-style: normal;
      font-weight: 700;
      font-size: 20px;
      line-height: 23px;
      text-align: center;
      margin-bottom: 30px;
      width: 250px;
      height: 123px;
      left: 193px;
      top: 249px;
      display: flex;
      align-items: center;
      padding-left: 20px;
      min-width: 270px;
      background: #2D3875;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      border-radius: 20px;
      padding: 15px;
    }
  </style>
    @auth
        @if (auth()->user()->typage_type == "App\Models\Servidor")

            <div class="container">
                <div>
                    <h1 style="font-style: normal; padding-top: 38px;
                            font-weight: 700; text-align:start ;
                            font-size: 35px; line-height: 41px; color: #131833;">
                        Bem-vindo(a)!
                    </h1>
                    <hr>
                    <br>
                </div>

                @foreach ($programas as $programa)
                    <div style="display:flex; flex-wrap:wrap; align-items:center; gap:5%; ">
                        <button class="botaoverde" href="{{url("/programas/".$programa->id."/editais")}}" onclick="window.location.href='{{url("/programas/".$programa->id."/editais")}}'">
                            <img src="{{asset("images/vertical_split.png")}}" alt="logodoc" style="padding-right: 10px;">
                            <p style="margin: auto; padding-right: 5px">{{ $programa->nome }}</p>
                        </button>
                    </div>
                @endforeach
            </div>

        @endif
    @endauth

    @auth
        @if (auth()->user()->typage_type == "App\Models\Aluno")

        <div class="container">
            <div>

                <h1
                style="font-style: normal; padding-top: 38px;
                font-weight: 700; text-align:start ;
                font-size: 35px; line-height: 41px; color: #131833;">
                Bem-vindo(a)!
                </h1>
                <hr>
                <br>

            </div>

            <div style="display:flex; flex-wrap:wrap; align-items:center; gap:5%; ">

                {{--  <button class="botaoverde">
                    <img src="{{asset('images/DocumentAdd.png')}}" alt="logodoc" style="padding-right: 10px;">
                    <p style="margin: auto; padding-right: 5px"> Listar documentos </p>
                </button>  --}}

                <button class="botaoverde" ref="{{url('/listar-modelos')}}" onclick="window.location.href="{{ url('/listar-modelos') }}">
                    <img src="{{asset('images/DocumentAdd.png')}}" alt="logodoc" style="padding-right: 10px;">
                    <p style="margin: auto; padding-right: 5px"> Listar modelos de documentos </p>
                </button>

                {{--  <button class="botaoazul">
                    <img src="{{asset('images/documentoadicionaricon.png')}}" alt="logodoc" style="padding-right: 10px;">
                    <p style="margin: auto; padding-right: 5px"> Gerar documentos </p>
                </button>  --}}
                {{--
                <button class="botaoverde">
                    <img src="{{asset('images/certificadoicon.png')}}" alt="logodoc" style="padding-right: 10px;">
                    <p style="margin: auto; padding-right: 5px"> Ver meus certificados </p>
                </button>  --}}

                <button class="botaoazul" ref="{{url("/index_aluno")}}" onclick="window.location.href='{{url("/index_aluno")}}'">
                    <img src="{{asset("images/programaicon.png")}}" alt="logodoc" style="padding-right: 10px;">
                    <p style="margin: auto; padding-right: 5px"> Ver meus editais </p>
                </button>

            </div>

            {{--
                <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">
                    <button class="botaoverde" ref="{{url("/listar-modelos")}}" onclick="window.location.href='{{url("/listar-modelos")}}'">
                        <img src="{{asset("images/DocumentAdd.png")}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px"> Listar modelos de documentos </p>
                    </button>

                </div>
             --}}

        </div>

        @endif
    @endauth

    @auth
        @if (auth()->user()->typage_type == "App\Models\Orientador")

        <div class="container">
            <div>

            <h1
            style="font-style: normal; padding-top: 38px;
            font-weight: 700; text-align:start ;
            font-size: 35px; line-height: 41px; color: #131833;">
            Bem vindo(a)!
            </h1>
            <hr>
            <br>

            </div>

            <div style="display:flex; flex-wrap:wrap; align-items:center; gap:5%; ">
                <button class="botaoverde" href="{{url("/MeusAlunos")}}" onclick="window.location.href='{{url("/MeusAlunos")}}'">
                    <img src="{{asset("images/user.png")}}" alt="user" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px">Listar alunos </p>
                </button>

                <button class="botaoazul" href="{{url("/MeusProgramas/")}}" onclick="window.location.href='{{url("/MeusProgramas/")}}'">
                    <img src="{{asset("images/programaicon.png")}}" alt="logodoc" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px"> Meus editais </p>
                </button>


                {{--  <button class="botaoverde">
                    <img src="{{asset('images/certificadoicon.png')}}" alt="logodoc" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px"> Meus certificados </p>
                </button>  --}}


                {{--  <button class="botaoazul">
                    <img src="{{asset('images/programaicon.png')}}" alt="logodoc" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px">  Visualizar documentos </p>

                </button>  --}}

                <button class="botaoverde">
                    <img src="{{asset('images/calendar.png')}}" alt="calendario" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 10px"> Visualizar frequência mensal </p>
                </button>
            </div>

            <br>

            {{--  <div style="display: flex; gap: 5%; align-items: center; margin: auto;">
                <button class="botaoverde">
                    <img src="{{asset('images/calendar.png')}}" alt="calendario" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 10px"> Visualizar frequência mensal </p>
                </button>

            </div>  --}}

        </div>

        @endif
    @endauth

@endsection
