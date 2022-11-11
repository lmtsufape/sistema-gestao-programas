@extends("vinculos.pdfs.certificados.app")

@section("body")
  <br>
  <br>
  <div class="text">
    Certificamos que o(a) Universitário(a) <strong>{{$vinculo->aluno->user->name}}</strong>, docurso de 
    <strong>Bacharelado em {{$vinculo->curso}}</strong>, realizou as atividades no <strong>Programa de 
    Tutoria da Universidade Federal do Agreste de Pernambuco - UFAPE</strong>, na disciplina de 
    <strong>{{$vinculo->disciplina}}</strong>, durante o semestre letivo <strong>2020.1 e 2020.2 (ano 2021)</strong>, 
    totalizando {{$vinculo->quantidade_horas}}, sob orientação do(a) Professor(a) <strong>{{$vinculo->professor->nome}}</strong>.
  </div>
  <div class="cidade" style="margin-right: 50px; margin-top: 30px">
    Garanhuns-PE, <?php 
      echo date('d/m/Y');
    ?>
  </div>

  <div class="assinaturas" >
    <div class="assinatura-coord">
      <hr class="line-ass">
      <strong>Airon Aparecido Silva de Melo</strong><br>
      Reitor da UFAPE
    </div>
    <div class="assinatura-reit">
      <hr class="line-ass">
      <strong>Emanuelle Camila Moraes de Melo Albuquerque Lima</strong><br>
      Pró-Reitora de Ensino e Graduação/UFAPE
    </div>
  </div>

@endsection

  