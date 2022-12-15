<!DOCTYPE html>
<html lang="en">
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
    <title>TJDV</title>
  </head>

  <body class="d-flex flex-column min-vh-100">
    <header>
      <nav class="navbar navbar-dark d-flex" style="background: #F4F5FB; box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);">
        <div class="container-fluid">
          @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
              <span class="navbar-toggler-icon"></span>
            </button>

            @include('templates.menu_lateral')
          @endauth

          <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
            <a href="{{route('home')}}" type="button" style=" text-decoration: none ; font-weight: 700; font-size: 24px; line-height: 29px; color: #131833; margin-left: 50px">
              PROGRAMA
            </a>
          </ul>
          <a href="{{route('home')}}" type="button" style=" text-decoration: none ; font-weight: 400; font-size: 20px; line-height: 29px; color: #131833; margin-left: 50px">
              Contato
          </a>
          <div style="border-right: 1px solid #131833; width: 1px; height: 30px; padding-left: 2%;"></div>
          <a href="{{route('home')}}" type="button" style="text-decoration: none ; font-weight: 400; font-size: 20px; line-height: 29px; color: #131833; margin-left: 2%; margin-right: 25px">
              Sobre
          </a>
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

    <footer style="background: #FFFFFF; box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25); margin-top: auto;
     display: flex; align-items: center; padding-top: 10px; padding-bottom: 10px;">
      <a href="{{route('home')}}" type="button" style=" text-decoration: none ; font-weight: 700;
          font-size: 24px; line-height: 29px; color: rgba(0, 0, 0, 0.46); margin-left: 60px;">
                PROGRAMA
          </a>
      <div style="margin-top: 5px; margin-bottom: 5px; margin-left:27% ; margin-right: auto; display: flex; align-items: center;">

        <img src="{{asset("images/logoufape.png")}}" alt="Logo da UFAPE" style="height: 50px;">
        <img src="{{asset("images/logoupe.png")}}" alt="Logo da UPE" style="height: 40px; margin-left: 10px;">

      </div>
    </footer>
  </body>
</html>
