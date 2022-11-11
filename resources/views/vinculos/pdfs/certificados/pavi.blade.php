@extends("vinculos.pdfs.certificados.app")

@section("body")
  <div class="text">
    Certificamos que o(a) Universitário(a) <strong>{{$vinculo->aluno->user->name}}</strong>, do curso de <strong>Bacharelado em
    {{$vinculo->disciplina}}</strong>, CPF. nº <strong>{{$vinculo->aluno->cpf}}</strong>, realizou as atividades do 
    <strong>ProgramadeAtividades de Vivência Interdisciplinar – PAVI {{$vinculo->semestre}}</strong>, na área de 
    <strong>Vinculo precisa de uma área de atuação quando for PAVI</strong>, 
    desenvolvidas no Hospital Veterinário Universitário - HVU, da Unidade Acadêmica de Garanhuns, 
    da Universidade Federal Rural de Pernambuco - UFRPE, atualmente, <strong>da Universidade Federal do Agreste de Pernambuco - UFAPE</strong>, 
    durante o período <strong>{{$vinculo->data_inicio}} a {{$vinculo->data_fim}}</strong>, totalizando {{$vinculo->quantidade_horas}} horas, 
    sob orientação do Médico Veterinário <strong>{{$vinculo->professor->nome}}</strong>.
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

  