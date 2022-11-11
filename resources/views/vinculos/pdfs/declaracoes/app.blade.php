<!DOCTYPE html>
<html lang="en" style="margin: 0px">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="css/projeto/pdfs/dec.css" rel="stylesheet" type="text/css" />
  <title>Declaração - {{$vinculo->aluno->user->name}} - {{$vinculo->programa}}</title>
</head>
<body>
  <div class="declaracao">
    <div class="head">
      <img src="{{ base_path() }}/public/images/logo-ufape-dec.png" class="ufape" alt=""> <br>
      <strong>UNIVERSIDADE FEDERAL DO AGRESTE DE PERNAMBUCO</strong> <br> 
      PRÓ-REITORIA DE ENSINO E GRADUAÇÃO <br> 
      <strong>DEPARTAMENTO DE PRÁTICAS DE FORMAÇÃO INICIAL E CONTINUADA</strong> <br> 
      <strong>COORDENADORIA DE PROGRAMAS ACADÊMICOS</strong> <br> 
    </div>

    <div class="title">
      <strong>DECLARAÇÃO</strong>
      <hr class="title-line">
    </div>
    
    @yield('body')
    
  </div>
</body>


</html>