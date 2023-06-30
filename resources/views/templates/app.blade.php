<!DOCTYPE html>
<html lang="en">

    <style>
        /* select single */
        .required .chosen-single {
            background: #F5F5F5;
            border-radius: 13px;
            border: 1px #D3D3D3;
            padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
        }
        /* select multiple */
        .required .chosen-choices {
            background: #F5F5F5;
            border-radius: 13px;
            border: 1px #D3D3D3;
            padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
        }
        footer {
          margin-top: auto;
          fixed: bottom;
        }

        .col-md-4:nth-child(2) {
          display: flex;
          flex-direction: column;
          align-items: center;
        }

        .col-md-4:nth-child(2) a:last-child {
          margin-top: 5px;
        }

          .container-fluid.pt-1.mt-5 {
            flex: 1; /* Allow the container to grow and push the footer to the bottom */

          }


    </style>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/projeto/app.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>

    <title>Sistema de Gestão de Programas Academicos</title>

  </head>

  <body class="d-flex flex-column min-vh-100">
    <div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
        <ul id="menu-barra-temp" style="list-style:none;">
          <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
              <a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
          </li>
          <li>
             <a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
          </li>
        </ul>                                                                                                                                                                                                                                                   
      </div>
    <header>
      <!-- Isso aqui é a barra de cima -->
      <nav class="navbar navbar-dark d-flex" style="background: #F4F5FB; box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);">
        <div class="container-fluid">
          @auth
          <!-- Isso aqui é o botão da barra lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
            aria-controls="offcanvasWithBothOptions">
              <span><img src="{{asset("images/sanduiche.png")}}" alt="sanduiche" style="width: 20px; height: 20px;"></span>
            </button>

            @include('templates.menu_lateral')
          @endauth
          
          <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
            @auth
              <a href="{{route('home')}}" type="button" style=" text-decoration: none ; font-weight: 700; font-size: 24px; line-height: 29px; color: #131833; margin-left: 50px">
                SISTEMA DE GESTÃO DE PROGRAMAS ACADÊMICOS
              </a>
            @else
                <a href="{{url('/')}}" type="button" style="text-decoration: none ; font-weight: 700; font-size: 15px; line-height: 29px; color: #131833">
                  SISTEMA DE GESTÃO DE PROGRAMAS ACADÊMICOS
                </a>

            @endauth

          </ul>
          <h2 style="font-style: normal; font-weight: 400; font-size: 18px; line-height: 30px; color: #131833; ">
            @auth
              Olá, {{Auth::user()->name}}
            @endauth
          </h2>
          @auth
          <div style="border-right: 1px solid #131833; width: 1px; height: 30px; padding-left: 2%;"></div>
          @endauth

          <div style="padding-left:2%; display:flex; align-items:center; margin-top:10px">
            @auth
            <form action="/logout" method="POST">
              @csrf
              <a href="/logout"  onclick="event.preventDefault(); this.closest('form').submit()" class="link_navbar">
                <img src="{{asset("images/logout.png")}}" alt="logout" style="height:30px; width:30px;">
                <p style="font-style: normal; font-weight: 400; font-size: 18px; line-height: 29px;
                margin-left: 5px;"> Sair </p>
              </a>
            </form>
            @else
            <ul class="lista-inline" style="text-align: right;">
              <li>
                  <a href="/" style="text-decoration: none ; font-weight: 700; font-size: 15px; line-height: 29px; color: #131833">Início</a>
              </li>
              <li>
                  <a href="/sistema" style="text-decoration: none ; font-weight: 700; font-size: 15px; line-height: 29px; color: #131833">O Sistema</a>
              </li>
              <li>
                <a href="/parceria" style="text-decoration: none ; font-weight: 700; font-size: 15px; line-height: 29px; color: #131833">A Parceria</a>
              </li>
              <li>
                <a href="/contato" style="text-decoration: none ; font-weight: 700; font-size: 15px; line-height: 29px; color: #131833; margin-right: 15px;">Contato</a>
              </li>

            </ul>

            @endauth
          </div>
        </div>
      </nav>
    </header>

    <div>
      <div style="text-align: center">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @endif
        @yield('body')
      </div>
    </div>

    {{-- <footer style="background: #FFFFFF; box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25); margin-top: auto;
     display: flex; align-items: center; padding-top: 10px; padding-bottom: 10px;">
      <a href="{{route('home')}}" type="button" style=" text-decoration: none ; font-weight: 700;
          font-size: 24px; line-height: 29px; color: rgba(0, 0, 0, 0.46); margin-left: 60px;">
                PROGRAMA
          </a>
      <div style="margin-top: 5px; margin-bottom: 5px; margin-left:27% ; margin-right: auto; display: flex; align-items: center;">

        <img src="{{asset("images/logoUfape.jpg")}}" alt="Logo da UFAPE" style="height: 50px;">
        <img src="{{asset("images/logoupe.png")}}" alt="Logo da UPE" style="height: 40px; margin-left: 10px;">

      </div>
    </footer> --}}

    <footer style="background-color: #F8FAFC">
      <div class="container-fluid px-lg-5">
        <div class="row justify-content-between  my-2">
          <div class="col-md-4 d-flex align-items-center justify-content-center py-1">
            <a class="navbar-brand mx-3" href="">
              <img width="250px" src="{{asset('images/sgpa-azul_2.svg')}}">
            </a>
          </div>

          <div class="col-md-4 text-center py-1">
            <div class="form-row">
              <div class="col-md-12">
                <h6 class="textoRodape">Desenvolvido por:</h6>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12" style="margin-bottom: 1rem;">
                <div class="row justify-content-center">
                  <div class="col-4">
                    <a href="http://ufape.edu.br/" target="_blank">
                      <img src="{{ asset('images/_BRASÃO_COLORIDO_SIGLA_PNG.png') }}" alt="Logo" width="65px;" style="float: right">
                    </a>
                  </div>
                  <div class="col-4">
                    <a href="http://lmts.uag.ufrpe.br/" target="_blank">
                      <img src="{{ asset('images/logo_ufape_color.png') }}" alt="Logo" width="120px" style="border-left: 1px rgba(0, 0, 255, 0.274) solid; padding-left: 15px; margin-top: 3%">
                    </a>
                  </div>
                  <div class="col-4">
                    <a href="https://upe.br/" target="_blank">
                      <img src="{{ asset('images/logoupe.png') }}" alt="Logo" width="70px" style="margin-top: 10px; margin-right: 80px;">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 text-center mt-1">
            <span class="textoRodape">Redes do LMTS:</span>
            <div class="row justify-content-center text-center mt-4">
              <a href="https://www.facebook.com/LMTSUFAPE/" target="_blank" class="col-md-1 p-0">
                <img height="40" src="{{asset('images/facebook_logo.png')}}">
              </a>
              <a href="https://www.instagram.com/lmts_ufape/" target="_blank" class="col-md-1 p-0 mx-2">
                <img height="40" src="{{asset('images/instagram_logo.png')}}">
              </a>
              <a href="mailto:lmts@ufrpe.br" class="col-md-1 p-0">
                <img height="40" src="{{asset('images/google_logo.png')}}">
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

  </body>
</html>
