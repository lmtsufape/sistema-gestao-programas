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
      

      background: #2D3875;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      border-radius: 20px;
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
              Bem vindo(a)!
              </h1>
              <hr>
        
        
            </div>
        
            <div>
                <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">
            
                    <button class="botaoverde">
                        <img src="{{asset("images/vertical_split.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Listagem programas
                    </button>
                
                    <button class="botaoazul">
                        <img src="{{asset("images/listuser.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Listar orientadores
                    </button>
                
                    <button class="botaoverde">
                        <img src="{{asset("images/listuser.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Listar alunos
                    </button>
                
                    <button class="botaoazul">
                        <img src="{{asset("images/adduser.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Adicionar aluno
                    </button>
                
                </div>
                
                <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">
            
                    <button class="botaoverde">
                        <img src="{{asset("images/ion_documents-outline.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Analisar documentos
                    </button>
                
                    <button class="botaoazul">
                        <img src="{{asset("images/listdoc.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Listar documentos
                    </button>
                
                    <button class="botaoverde">
                        <img src="{{asset("images/gear.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Gerenciar editais
                    </button>
                
                    <button class="botaoazul">
                        <img src="{{asset("images/gear.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Gerenciar certificados e declarações
                    </button>
                    
                </div>

                <div style="display: flex; gap: 5%; align-items: center; margin-top: 1% ; margin-bottom: 1% ; margin-left: 2%">
            
                    <button class="botaoverde">
                        <img src="{{asset("images/calendar-exclamation.png")}}" alt="logodoc" style="padding-right: 10px;">
                        Notificar prazos
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
            Bem vindo(a)!
            </h1>
            <hr>
        
        
            </div>
        
            <div style="display: flex; gap: 5%; align-items: center; margin: auto;">
        
            <button class="botaoverde">
                <img src="{{asset("images/DocumentAdd.png")}}" alt="logodoc" style="padding-right: 10px;">
                Listagem de documentos
            </button>
        
            <button class="botaoazul">
                <img src="{{asset("images/documentoadicionaricon.png")}}" alt="logodoc" style="padding-right: 10px;">
                Gerar documentos
            </button>
        
            <button class="botaoverde">
                <img src="{{asset("images/certificadoicon.png")}}" alt="logodoc" style="padding-right: 10px;">
                Meus certificados
            </button>
        
            <button class="botaoazul">
                <img src="{{asset("images/programaicon.png")}}" alt="logodoc" style="padding-right: 10px;">
                Meus programas
            </button>
            
            </div>    
            
        </div>
        
        @endif
    @endauth

    @auth
        @if (auth()->user()->typage_type == "App\Models\Professor")
            
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

                <button class="botaoverde">
                    <img src="{{asset("images/DocumentAdd.png")}}" alt="logodoc" style="padding-right: 10px;">
                    Listagem de documentos
                </button>

                <button class="botaoazul">
                    <img src="{{asset("images/documentoadicionaricon.png")}}" alt="logodoc" style="padding-right: 10px;">
                    Gerar documentos
                </button>

                <button class="botaoverde">
                    <img src="{{asset("images/certificadoicon.png")}}" alt="logodoc" style="padding-right: 10px;">
                    Meus certificados
                </button>

                <button class="botaoazul">
                    <img src="{{asset("images/programaicon.png")}}" alt="logodoc" style="padding-right: 10px;">
                    Meus programas
                </button>
            
            </div>           
            
        </div>
        
        @endif
    @endauth
    {{--  <h1><strong>Programas</strong></h1>
    <div class="container">
        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">Todas as bolsas</h3>    
            </button>
        </form>
        
        <form action="{{route("vinculos.index")}}" method="get">
            <input name="programa" type="hidden" value="MONITORIA">
            <button class="block-programas">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">Monitorias</h3>
            </button>
        </form>
        
        <form action="{{route("vinculos.index")}}" method="get">
            <input name="programa" type="hidden" value="TUTORIA">
            <button class="block-programas">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">Tutorias</h3>
            </button>
        </form>

        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <input name="programa" type="hidden" value="PAVI">   
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">PAVI</h3>
            </button>
        </form>

        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <input name="programa" type="hidden" value="BIA">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">BIA</h3>
            </button>
        </form>

        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <input name="programa" type="hidden" value="PET">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">PET</h3>
            </button>
        </form>

        
    </div>  --}}
@endsection