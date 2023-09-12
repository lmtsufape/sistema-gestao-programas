@extends("templates.app")

@section("body")

<style>
  pagination {
    display: inline-block;
  }

  .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 10px 4px;
  }

  .pagination a.active {
    background-color: #3B864F;
    color: white;
    border: 1px solid #3B864F;
  }

  .pagination a:hover:not(.active) {
    background-color: #34A853;
  }

  .textolegenda {
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 130%;
    margin: 5px
  }
</style>
@if (session('sucesso'))
<div class="alert alert-success">
  {{session('sucesso')}}
</div>
@endif

<div style="display: flex; justify-content: space-evenly; align-items: center;">
  <h1 class="titulo"><strong>Meus Editais - Vinculos Ativos</strong></h1>
</div>

<form class="search-container" action="" method="GET">
  <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
  <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
</form>

<br>
<br>

<div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
  <div class="col-md-9 corpo p-2 px-3">
    <table class="table">
      <thead class=table-head>
        <tr>
          <th scope="col" class="text-center">Título</i></th>
          <th scope="col" class="text-center">Data de início</th>
          <th scope="col" class="text-center">Data de fim</th>
          <th scope="col" class="text-center">Programa</th>
          <th scope="col" class="text-center">Ações</th>
        </tr>
      </thead>
      @foreach ($editais as $edital)
      <tbody>
        <tr>

          <td class="align-middle">{{ $edital->titulo_edital}}</td>
          <td class="align-middle">{{date_format(date_create($edital->data_inicio), "d/m/Y")}}</td>
          <td class="align-middle">{{date_format(date_create($edital->data_fim), "d/m/Y")}}</td>
          <td class="align-middle">{{$edital->programa->nome}}</td>
          <td class="align-middle">

            <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{$edital->id}}">
              <img src="{{asset("images/information.svg")}}" alt="Info edital" style="height: 30px; width: 30px;">
            </a>
            <a class="link" alt="Listar orientadores" href="{{  route('edital.listar_orientadores', ['id' => $edital->id]) }}">
              <img src="{{asset("images/orientadores.svg")}}" alt="Listar orientadores" style="height: 30px; width: 30px;">
            </a>
            @if ($edital->programa->nome == 'Monitoria')
            <a type="button" data-bs-toggle="modal" data-bs-target="#modal_frequencia">
              <img src="{{asset("images/document.svg")}}" alt="Frequencia" style="height: 30px; width: 30px;">
            </a>
            @endif

          </td>
        </tr>

      </tbody>
      @include("Edital.components.modal_show", ["edital" => $edital])
      @include("Alunos.components.modal_frequencia")
      @endforeach
    </table>
  </div>
</div>
@endsection