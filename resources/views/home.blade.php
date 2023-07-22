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
      min-width: 250px;
      background: #34A853;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      margin-bottom: 30px;
      border-radius: 20px;
    }

    .botaoverde:hover{
        transform: scale(1.08);
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
      min-width: 250px;
      background: #2D3875;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      border-radius: 20px;
      padding: 15px;
    }

    .botaoazul:hover{
        transform: scale(1.08);
    }

    .container {
        min-height: calc(85vh - 100px); /* Subtract the footer height from the viewport height */
        display: flex;
        flex-direction: column;
      }

  </style>
    @auth
        @if (auth()->user()->typage_type == "App\Models\Servidor")

            <div class="container">
                <div>
                    <h1 style="font-style: normal; padding-top: 38px;
                            font-weight: 700; text-align:start ;
                            font-size: 35px; line-height: 41px; color: #131833;">
                        Bem-vindo(a) {{auth()->user()->name}}!
                    </h1>
                    <hr>
                    <br>
                </div>

                {{--  condição para se for admin aparacer a opão de Cadastrar programa  --}}

                @if (auth()->user()->typage->tipo_servidor == 'admin')

                <div style="display:flex; flex-wrap:nowrap; align-items:center; gap:4%;">
                    <div style="display:flex; flex-wrap:wrap; align-items:center; gap:4%; ">
                        <button class="botaoazul" ref="{{url("/programas/create")}}" onclick="window.location.href='{{url("/programas/create")}}'">
                            <img src="{{asset("images/biggerplus.png")}}" alt="logodoc" style="padding-right: 10px;">
                            <p style="margin: auto; padding-right: 5px"> Cadastrar programa </p>
                        </button>
                    </div>

                    {{--  Cadastrar edital  --}}
                    <div style="display:flex; flex-wrap:wrap; align-items:center; gap:4%; ">
                        <button class="botaoverde" ref="{{url("/editais/create")}}" onclick="window.location.href='{{route("edital.create")}}'">
                            <img src="{{asset("images/biggerplus.png")}}" alt="logodoc" style="padding-right: 10px;">
                            <p style="margin: auto; padding-right: 5px"> Cadastrar <br> edital </p>
                        </button>
                    </div>

                    {{--  Cadastrar disciplina  --}}
                    <div style="display:flex; flex-wrap:wrap; align-items:center; gap:4%; ">
                        <button class="botaoazul" ref="{{url("/disciplinas/create")}}" onclick="window.location.href='{{url("/disciplinas/create")}}'">
                            <img src="{{asset("images/biggerplus.png")}}" alt="logodoc" style="padding-right: 10px;">
                            <p style="margin: auto; padding-right: 5px"> Cadastrar disciplina </p>
                        </button>
                    </div>

                    {{--  Cadastrar curso  --}}
                    <div style="display:flex; flex-wrap:wrap; align-items:center; gap:4%; ">
                        <button class="botaoverde" ref="{{url("/cursos/create")}}" onclick="window.location.href='{{url("/cursos/create")}}'">
                            <img src="{{asset("images/biggerplus.png")}}" alt="logodoc" style="padding-right: 10px;">
                            <p style="margin: auto; padding-right: 5px"> Cadastrar <br> curso </p>
                        </button>
                    </div>
                </div>
                @endif
                @if (auth()->user()->typage->tipo_servidor == 'gestor')

                @endif
                <h2 style="font-style: normal; padding-top: 38px;font-weight: 700; text-align:start;
                    font-size: 35px; line-height: 41px; color: #131833;">
                    Programas
                </h2>
                <hr>
                <br>
                <div style="display:flex;flex-wrap: wrap;align-items:center;gap: 4%;justify-content: flex-start;">
                    @foreach ($programas as $index => $programa)
                      @if ($index % 2 == 0)
                        <button class="botaoazul" href="{{url("/programas/".$programa->id."/editais")}}" onclick="window.location.href='{{url("/programas/".$programa->id."/editais")}}'">
                      @else
                        <button class="botaoverde" href="{{url("/programas/".$programa->id."/editais")}}" onclick="window.location.href='{{url("/programas/".$programa->id."/editais")}}'">
                      @endif
                      <img src="{{asset("images/vertical_split.png")}}" alt="logodoc" style="padding-right: 10px;">
                      <p style="margin: auto; padding-right: 5px">{{ $programa->nome }}</p>
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
            <div>

                <h1
                style="font-style: normal; padding-top: 38px;
                font-weight: 700; text-align:start ;
                font-size: 35px; line-height: 41px; color: #131833;">
                Bem-vindo(a) {{auth()->user()->name}}!
                </h1>
                <hr>
                <br>

            </div>

            <div style="display:flex; flex-wrap:wrap; align-items:center; gap:5%; ">

                {{--  <button class="botaoverde">
                    <img src="{{asset('images/DocumentAdd.png')}}" alt="logodoc" style="padding-right: 10px;">
                    <p style="margin: auto; padding-right: 5px"> Listar documentos </p>
                </button>  --}}

                <button class="botaoverde" ref="{{url("/listar-modelos")}}" onclick="window.location.href='{{url("/listar-modelos")}}'">
                    <img src="{{asset('images/DocumentAdd.png')}}" alt="logodoc" style="padding-right: 10px;">
                    <p style="margin: auto; padding-right: 5px"> Listar modelos de documentos </p>
                </button>

                <button class="botaoazul" ref="{{url('/editais-aluno')}}" onclick="window.location.href='{{url('/editais-aluno')}}'">
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
                <button class="botaoverde" href="{{url('/listar_alunos-orientador')}}" onclick="window.location.href='{{url('/listar_alunos-orientador')}}'">
                    <img src="{{asset("images/user.png")}}" alt="user" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px">Listar alunos </p>
                </button>

                <button class="botaoazul" href="{{url('/editais-orientador')}}" onclick="window.location.href='{{url('/editais-orientador')}}'">
                    <img src="{{asset("images/programaicon.png")}}" alt="logodoc" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px"> Meus editais </p>
                </button>

                <button class="botaoverde" href="{{url("/listar-modelos")}}" onclick="window.location.href='{{url("/listar-modelos")}}'">
                    <img src="{{asset('images/programaicon.png')}}" alt="logodoc" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px">   Listar modelos de documentos </p>

                </button>
            </div>
            <br>
        </div>
        @endif
    @endauth

@endsection
