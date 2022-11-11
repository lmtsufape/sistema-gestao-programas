@extends("vinculos.pdfs.declaracoes.app")

@section("body")

  <div class="message monitoria">

    Declaramos que o(a) Médico Veterinário <strong>Dr. {{$vinculo->professor->nome}}</strong>, SIAPE nº 
    <strong>{{$vinculo->professor->sipe}}</strong>, 
    orientou o(a) discente <strong>{{$vinculo->aluno->user->name}}</strong>, do curso de
    <strong>Bacharelado em {{$vinculo->aluno->curso}}</strong>, nas atividades do 
    <strong>Programa de AtividadesdeVivência Interdisciplinar – PAVI 2021.1/2022</strong> , 
    na área de <strong>Vínculo precisa de uma area de atuação</strong>, desenvolvidas no <strong>Hospital Veterinário Universitário - HVU, 
    da UniversidadeFederal do Agreste de Pernambuco - UFAPE</strong>, durante o período de 
    <strong>{{$vinculo->data_inicio}} a {{$vinculo->data_fim}}</strong>.

  </div>

  <div class="cidade">
    Garanhuns-PE, <?php 
      echo date('d/m/Y');
    ?>.
  </div>

  <br><br><br>

  <div >
    <img src="{{ base_path() }}/public/images/assinaturas/emanuelle.png" alt=""> <br>
    <strong>Emanuelle Camila Moraes de Melo Albuquerque Lima </strong><br>
    Pró-Reitora de Ensino e Graduação <br>
    Portaria n° 151/2021/MEC
  </div>

  @for ($i=0; $i < 12; $i++)
    <br>
  @endfor    

  <div>
    Av. Bom Pastor, s/n – Boa Vista – CEP 55292-270 – Garanhuns, PE - Telefone: (87) 3764-5517
  </div>

@endsection

  