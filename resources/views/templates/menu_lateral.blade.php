<style>
    a:link {
        text-decoration: none;
        color: #000000;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 19px;
    }

    a:visited {
        text-decoration: none;
        color: #000000;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 19px;
    }

    a:hover {
      text-decoration: underline;
    }

    a:active {
      text-decoration: underline;
    }

</style>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
aria-labelledby="offcanvasWithBothOptionsLabel" style="background: #F4F5FB; box-shadow: 3px 0px 15px rgba(0, 0, 0, 0.25);">
  <div class="offcanvas-header" style="align-items: center; align-content: center">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Olá, {{auth()->user()->name}}!</h5>
    <button type="button" data-bs-dismiss="offcanvas" aria-label="Close" style=" background: #F4F5FB; border: none">
        <img src="{{asset("images/close.png")}}" alt="close" style="height:30px; width:30px;"></button>
  </div>
  <hr>
  <div class="offcanvas-body" style="display: flex;flex-direction: column;justify-content: space-between;">
    @auth
      @if (auth()->user()->typage_type == "App\Models\Servidor")

        <div style="padding: 5px;">
            <a href="{{route('meu-perfil')}}" style="display: flex; color: #000; text-decoration: none;">
                <img src="{{asset("images/iconsbarralateral/userbl.png")}}" alt="user" style="height:24px; width:24px;">
                <p style="font-style: normal; font-weight: 400; font-size: 14px;
                line-height: 16px; padding-left: 5px; padding-top: 4px">Meu perfil</p>
            </a>
            <hr>

            <a href="{{route("programas.index")}}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{asset("images/iconsbarralateral/listarbl.png")}}" alt="listarprog" style="height:17px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
              padding-top: 1px">Listar programas</p>
            </a>

            <a href="{{route("alunos.index")}}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{asset("images/iconsbarralateral/listaruserbl.png")}}" alt="listarAlunos" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
              padding-top: 4px">Listagem de alunos </p>
            </a>
            <a href="{{route("orientadors.index")}}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{asset("images/iconsbarralateral/listaruserbl.png")}}" alt="listarOri" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
              padding-top: 4px">Listagem de orientadores </p>
            </a>
            <a href="{{route("servidores.index")}}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{asset("images/iconsbarralateral/listaruserbl.png")}}" alt="listarServ" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
              padding-top: 4px">Listagem de servidores</p></a>
            <hr>
            <a href="{{ route('edital.index') }}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{ asset('images/iconsbarralateral/gearbl.png') }}" alt="gerenciar" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px; padding-top: 4px;">Gerenciar editais</p>
            </a>
            <a href="{{ route('disciplinas.index') }}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{ asset('images/iconsbarralateral/gearbl.png') }}" alt="gerenciar" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px; padding-top: 4px;">Gerenciar disciplinas</p>
            </a>
            <a href="{{ route('cursos.index') }}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{ asset('images/iconsbarralateral/gearbl.png') }}" alt="gerenciar" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px; padding-top: 4px;">Gerenciar cursos</p>
            </a>

            <hr>
            <h6 style="font-style: normal; font-weight: 700; font-size: 16px; line-height: 19px;">Envio de e-mails</h6>
            {{--  <a href="{{route("email.notificarPrazoFrequencia")}}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{asset("images/iconsbarralateral/prazobl.png")}}" alt="email" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
              padding-top: 5px">Notificar prazo de frequência mensal</p>
            </a>  --}}
            <a href="{{route("email.notificarPrazoRelatorio")}}" style="display: flex; color: #000; text-decoration: none;">
              <img src="{{asset("images/iconsbarralateral/prazobl.png")}}" alt="email" style="height:24px; width:24px;">
              <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
              padding-top: 5px">Notificar prazo de relatório final</p>
            </a>
        </div>

      @endif

      @if (auth()->user()->typage_type == "App\Models\Orientador")
      <div style="padding: 5px;">
        <a href="{{route('meu-perfil')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/userbl.png")}}" alt="user" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px;
            line-height: 16px; padding-left: 5px; padding-top: 4px">Meu perfil</p>
        </a>
        <hr>
        <a href="{{  route("alunos.index")  }}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/listaruserbl.png")}}" alt="listarAlunos" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 4px">Listar de alunos </p>
        </a>
        <hr>
        <a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/listarbl.png")}}" alt="listarprog" style="height:17px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 1px">Meus programas</p>
        </a>
        <a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/listardocbl.png")}}" alt="listardoc" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 4px">Meus documentos</p>
        </a>
        <a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/certificadobl.png")}}" alt="certificados" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 4px">Meus certificados</p>
        </a>
        <hr>
        <a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/listardocbl.png")}}" alt="listardoc" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 4px">Visualizar documentos</p>
        </a>
        <a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/prazobl.png")}}" alt="frequenciaMes" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 5px">Visualizar frequência mensal</p>
        </a>
        <hr>
      </div>
      @endif


      @if (auth()->user()->typage_type == "App\Models\Aluno")
      <div style="padding: 5px;">
        <a href="{{route('meu-perfil')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/userbl.png")}}" alt="user" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px;
            line-height: 16px; padding-left: 5px; padding-top: 4px">Meu perfil</p>
        </a>
        <hr>
        {{--<a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/certificadobl.png")}}" alt="certificados" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 4px">Meus certificados</p>
        </a>
        <hr>--}}
        <!-- <h6 style="font-style: normal; font-weight: 700; font-size: 16px; line-height: 19px;">Documentos</h6> -->
        <a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/listardocbl.png")}}" alt="listardoc" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 3px">Listar documentos</p>
        </a>
        <a href="{{route('home')}}" style="display: flex; color: #000; text-decoration: none;">
            <img src="{{asset("images/iconsbarralateral/novodocbl.png")}}" alt="novodoc" style="height:24px; width:24px;">
            <p style="font-style: normal; font-weight: 400; font-size: 14px; line-height: 16px; padding-left: 5px;
            padding-top: 5px">Gerar documentos</p>
        </a>
        </div>
      @endif
    @endauth

    <form action="/logout" method="POST">
        @csrf
        <hr>
        <a href="/logout"  onclick="event.preventDefault(); this.closest('form').submit()" style="display: flex;
        color: #000; text-decoration: none;">
          <img src="{{asset("images/logout.png")}}" alt="logout" style="height:30px; width:30px;">
           <p style="font-style: normal; font-weight: 400; font-size: 18px; line-height: 29px;
           padding-left: 5px;"> Sair </p>
        </a>

      </form>

  </div>
</div>
