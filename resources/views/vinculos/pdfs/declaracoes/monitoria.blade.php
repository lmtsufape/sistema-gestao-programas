@extends("vinculos.pdfs.declaracoes.app")

@section("body")

  <div class="message monitoria">

    Declaramos que o(a) Docente <strong>{{$vinculo->professor->nome}}</strong> desenvolveu atividadedeorientação no 
    <strong>Programa de Monitoria da Universidade Federal do Agreste de Pernambuco - UFAPE</strong> ,
    durante o semestre letivo <strong>{{$vinculo->semestre}} (ano 2022)</strong>, na disciplina de <strong>{{$vinculo->disciplina}}</strong>, 
    tendo como orientado(a) o(a) discente <strong>{{$vinculo->aluno->user->name}}</strong>, regularmente matriculado(a) no curso de 
    <strong>Bacharelado em {{$vinculo->aluno->curso}}</strong>

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

  @for ($i=0; $i < 16; $i++)
    <br>
  @endfor    

  <div>
    Av. Bom Pastor, s/n – Boa Vista – CEP 55292-270 – Garanhuns, PE - Telefone: (87) 3764-5517
  </div>

@endsection

  