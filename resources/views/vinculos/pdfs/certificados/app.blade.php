<!DOCTYPE html>
<html lang="en" style="margin: 0px">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="css/projeto/pdfs/cert.css" rel="stylesheet" type="text/css" />
  <title>Certificado - {{$vinculo->aluno->user->name}} - {{$vinculo->programa}}</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif;">
  <div class="lateral">
    <div class="ufape">UFAPE</div>
    <img src="{{ base_path() }}/public/images/logo_ufape.png" class="logo">
  </div>
  <div class="certificado">
    <div class="head">
      <div><strong>UNIVERSIDADE FEDERAL DO AGRESTE DE PERNAMBUCO</strong></div>
      <div>PRÓ-REITORIA DE ENSINO E GRADUAÇÃO</div>
      <div>DEPARTAMENTO DE PRÁTICAS DE FORMAÇÃO INICIAL E CONTINUADA</div>
      <div>COORDENADORIA DE PROGRAMAS ACADÊMICOS</div>
    </div>
    <hr class="line">
    <div class="title">
      CERTIFICADO
    </div>
    <br><br>
    @yield('body')
  </div>
  <div class="footer">
    Universidade Federal do Agreste de Pernambuco - CNPJ nº 35.872.812/0001-01 - Certificado registrado com o nº 005 CPAC/UFAPE/2022
  </div>
</body>


</html>