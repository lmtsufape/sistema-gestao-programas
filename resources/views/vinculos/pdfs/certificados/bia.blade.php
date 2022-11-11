@extends("vinculos.pdfs.certificados.app")

@section("body")
  <br>
  <br>
  <div class="text">
    Certificamos que o(a) Universitário(a) <strong>{{$vinculo->aluno->user->name}}</strong>, do curso de Bacharelado em
    <strong>{{$vinculo->disciplina}}</strong>, realizou as atividades no <strong>Programa de Bolsas de Incentivo Acadêmico
    – BIA </strong>, oferecido pela <strong>Fundação de Amparo à Ciência e Tecnologia de Pernambuco – FACEPE</strong> em
    parceria com a <strong>Universidade Federal do Agreste de Pernambuco – UFAPE</strong>, através do Projeto
    <strong>“Análise de uso pós-ocupação no Laboratório Multiusuários – LACTAL, da Universidade
    Federal do Agreste de Pernambuco”</strong>, no período de outubro de <strong>{{$vinculo->data_inicio}} a {{$vinculo->data_fim}}</strong>,
    totalizando <strong>{{$vinculo->quantidade_horas}}</strong> horas, sob orientação do(a) Professor(a) <strong>{{$vinculo->professor->nome}}</strong>.
  </div>
  <div class="cidade">
    Garanhuns-PE, <?php 
      echo date('d/m/Y');
    ?>
  </div>
  <br>

  <div class="assinaturas">
    <div class="assinatura-coord">
      <hr class="line-ass">
      <strong>Jean Carlos Teixeira de Araújo</strong><br>
      Coordenador Institucional BIA
    </div>
    <div class="assinatura-reit">
      <hr class="line-ass">
      <strong>Emanuelle Camila Moraes de Melo Albuquerque Lima</strong><br>
      Pró-Reitora de Ensino e Graduação
    </div>
  </div>

@endsection

  