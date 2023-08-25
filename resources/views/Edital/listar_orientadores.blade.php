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
</style>

<div class="container-fluid">
  @if (session('sucesso'))
  <div class="alert alert-sucess">
    {{session('sucesso')}}
  </div>
  @endif

  <br>

  <div style="display: flex; justify-content: space-evenly; align-items: center;">
      <h1 class = "titulo"><strong>Orientadores</strong></h1>
  </div>

    <form class="search-container" action="" method="GET">
        <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
        <input class="search-button" type="submit" value=""></input>
    </form>
    <br>
    <br>
 <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
      <table class="table">
        <thead>
          <tr class= table-head>
            <th scope="col" class="text-center">Nome</th>
            <th scope="col" class="text-center">Edital</th>
            <th scope="col" class="text-center">Data de Início</th>
            <th scope="col" class="text-center">Data de Fim</th>
            <th scope="col" class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
        @foreach($orientadores as $orientador)
          @foreach ($pivot as $pivo)
          <tr>
            <td class="align-middle"> {{ $orientador->name}} </td>
            <td class="align-middle"> {{ $pivo->titulo }} </td>
            <td class="align-middle"> {{ date('d/m/Y', strtotime($pivo->data_inicio)) }} </td>
            <td class="align-middle"> {{ date('d/m/Y', strtotime($pivo->data_fim)) }} </td>
            <td class="align-middle">
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{$orientador->id}}" >
                <img src="{{asset('images/information.svg')}}" alt="Informações do aluno" style="height: 30px; width: 30px;">
              </a>

              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents{{$orientador->id}}">
                <img src="{{asset('images/document.svg')}}" alt="Documentos do orientador" style="height: 30px; width: 30px;">
              </a>
            </td>
          </tr>
          @include('Edital.components_orientadores.modal_show', ['orientador' => $orientador, 'pivo' => $pivo])
          @include('Edital.components_orientadores.modal_documents', ['orientador' => $orientador, 'pivo' => $pivo])
          @endforeach
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <br>
  <br>
</div>

<script type="text/javascript">

  function exibirModalVisualizar(id) {
    $('#modal_show' + id).modal('show');
  }

  function exibirModalDocumentos(id) {
    $('#modal_documents' + id).modal('show');
  }

</script>


@endsection
