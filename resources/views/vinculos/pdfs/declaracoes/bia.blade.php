@extends("vinculos.pdfs.declaracoes.app")

@section("body")

  <div class="message monitoria">

    Declaramos que o(a) Docente  <strong>{{$vinculo->professor->nome}}</strong> desenvolveu atividade de 
    orientação no <strong>Programa Institucional de bolsas de Incentivo Acadêmico (BIA)</strong>, 
    oferecido pela <strong>Fundação de Amparo à Ciência e Tecnologia de Pernambuco – FACEPE</strong> em 
    parceria com a <strong>Universidade Federal do Agreste de Pernambuco - UFAPE</strong>, durante o 
    período de {{$vinculo->data_inicio}} a {{$vinculo->data_fim}}, através do Projeto <strong>“Uso de resíduos de 
    cana-de-açúcar para produção de cultivares de girassol”</strong>, tendo como orientado(a) 
    o(a) discente {{$vinculo->aluno->user->name}}, regularmente matriculado(a) no curso de 
    <strong>Bacharelado em {{$vinculo->aluno->curso}}</strong>.

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

  @for ($i=0; $i < 10; $i++)
    <br>
  @endfor    

  <div>
    Av. Bom Pastor, s/n – Boa Vista – CEP 55292-270 – Garanhuns, PE - Telefone: (87) 3764-5517
  </div>

@endsection

  