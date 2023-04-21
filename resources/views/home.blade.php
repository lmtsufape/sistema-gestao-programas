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
      width: 260px;
      height: 123px;
      left: 193px;
      top: 249px;
      display: flex;
      align-items: center;
      padding-left: 20px;
      min-width: 270px;
      background: #34A853;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
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
      width: 260px;
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

              <h1
              style="font-style: normal; padding-top: 38px;
              font-weight: 700; text-align:start ;
              font-size: 35px; line-height: 41px; color: #131833;">
              Bem-vindo(a)!
              </h1>
              <hr>


            </div>

            <div>
                <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">

                    <button class="botaoverde" href="{{url('/programas/')}}" onclick="window.location.href='{{url('/programas/')}}'" >
                        <img src="{{asset('images/vertical_split.png')}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px">Listar programas </p>
                    </button>

                    <button class="botaoazul" href="{{url('/orientadors/')}}" onclick="window.location.href='{{url('/orientadors/')}}'">
                        <img src="{{asset('images/listuser.png')}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px">Listar orientadors </p>
                    </button>

                    <button class="botaoverde" href="{{url('/alunos/')}}" onclick="window.location.href='{{url('/alunos/')}}'" >
                        <img src="{{asset('images/listuser.png')}}" alt="logodoc"style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px">Listar alunos </p>
                    </button>

                    <button class="botaoazul" ref="{{url('/alunos/create')}}" onclick="window.location.href='{{url('/alunos/create')}}'">
                        <img src="{{asset('images/adduser.png')}}" alt="logodoc" style="padding-right: 10px; padding-left: 10px;">
                        <p style="margin: auto; padding-right: 5px">Adicionar aluno </p>
                    </button>

                </div>

                <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">

                    <button class="botaoverde">
                        <img src="{{asset('images/ion_documents-outline.png')}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px">Analisar documentos </p>
                    </button>

                    <button class="botaoazul">
                        <img src="{{asset('images/listdoc.png')}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px">Listar documentos </p>
                    </button>

                    <button class="botaoverde" ref="{{url('/editals')}}" onclick="window.location.href='{{url('/editals')}}'">
                        <img src="{{asset('images/gear.png')}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px">Gerenciar editais </p>
                    </button>

                    <button class="botaoazul">
                        <img src="{{asset('images/gear.png')}}" alt="logodoc" style="padding-right: 10px;  padding-left: 10px;">
                        <p style="margin: auto; padding-right: 5px"> Gerenciar certificados e declarações  </p>
                    </button>

                </div>

                <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">

                    <button class="botaoverde">
                        <img src="{{asset('images/calendar-exclamation.png')}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px"> Notificar prazos de relatórios </p>
                    </button>
                    <button class="botaoazul">
                        <img src="{{asset('images/calendar-exclamation.png')}}" alt="logodoc" style="padding-right: 10px;">
                        <p style="margin: auto; padding-right: 5px"> Notificar prazos de frequência </p>
                    </button>

                </div>
            </div>
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


            </div>

            <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">

            {{--  <button class="botaoverde">
                <img src="{{asset('images/DocumentAdd.png')}}" alt="logodoc" style="padding-right: 10px;">
                <p style="margin: auto; padding-right: 5px"> Listar documentos </p>
            </button>  --}}

            <button class="botaoverde" ref="{{url('/listar-modelos')}}" onclick="window.location.href="{{url('/listar-modelos')}}">
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

            <button class="botaoazul">
                <img src="{{asset('images/programaicon.png')}}" alt="logodoc" style="padding-right: 10px;">
                <p style="margin: auto; padding-right: 5px"> Ver meus programas </p>
            </button>


            </div>

            {{--  <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">
            <button class="botaoverde" ref="{{url('/listar-modelos')}}" onclick="window.location.href='{{url('/listar-modelos')}}'">
                <img src="{{asset('images/DocumentAdd.png')}}" alt="logodoc" style="padding-right: 10px;">
                <p style="margin: auto; padding-right: 5px"> Listar modelos de documentos </p>
            </button>
            </div>  --}}

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


            </div>

            <div style="display: flex; gap: 5%; align-items: center; margin: auto;">

                <button class="botaoverde" href="{{url('/alunos/')}}" onclick="window.location.href='{{url('/alunos/')}}'">
                    <img src="{{asset('images/user.png')}}" alt="user" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px">Listar alunos </p>
                </button>

                <button class="botaoazul" href="{{url('/programas/'}}" onclick="window.location.href='{{url('/programas/')}}'">
                    <img src="{{asset('images/programaicon.png'}}" alt="logodoc" style="padding-right: 20px;">
                    <p style="margin: auto; padding-right: 5px"> Meus programas </p>
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
