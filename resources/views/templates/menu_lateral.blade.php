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
            <a href="{{route('home')}}">Meu perfil</a>
            <hr>
            <a href="{{route('home')}}">Listar programas</a>
            <hr>
            <a href="{{route("alunos.index")}}">Listagem de alunos</a>
            <hr>
            <a href="{{route('home')}}">Listagem de professores</a>
            <hr>
            <a href="{{route("servidores.index")}}">Listagem de servidores</a>
            <hr>
            <a class="links-menu" href="{{route('home')}}">Gerenciar editais</a>
            <hr>
            <h6 style="font-style: normal; font-weight: 700; font-size: 16px; line-height: 19px;">Envio de e-mails</h6>
            <a href="{{route("email.notificarPrazoFrequencia")}}" >Notificar prazo de frequência mensal</a> <br>
            <a href="{{route("email.notificarPrazoRelatorio")}}">Notificar prazo de relatório final</a>
        </div>

      @endif
    @endauth

    <form action="/logout" method="POST">
        @csrf
        <hr>
        <a href="/logout"  onclick="event.preventDefault(); this.closest('form').submit()" style="display: flex; align-self: center;
        color: #000; text-decoration: none;">
          <img src="{{asset("images/logout.png")}}" alt="logout" style="height:30px; width:30px;">
           <p style="align-self: center; font-style: normal; font-weight: 400; font-size: 24px; line-height: 29px;
           padding-left: 5px;"> Sair </p>
        </a>

      </form>

  </div>
</div>
