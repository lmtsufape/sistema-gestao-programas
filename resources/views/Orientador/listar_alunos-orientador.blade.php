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
  <div class="alert alert-success">
    {{session('sucesso')}}
  </div>
  @endif
  <br>

  <div style="display: flex; justify-content: space-evenly; align-items: center;">
    <h1 class="titulo"><strong>Meus Alunos</strong></h1>
  </div>

  <form class="search-container" action="" method="GET">
    <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
    <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
  </form>
</div>

<br>
<br>

<div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
  <div class="col-md-9 corpo p-2 px-3">
    <table class="table">
      <thead>
        <tr class="table-head">
          <th scope="col" class="text-center">Nome</th>
          <th scope="col" class="text-center">Edital</th>
          <th scope="col" class="text-center">Data de Início</th>
          <th scope="col" class="text-center">Data de Fim</th>
          <th class="text-center" class="text-center">
            Ações
            <button type="button" class="infobutton" data-bs-toggle="modal" data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
              <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda" style="height: 20px; width: 20px;">
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($pivos as $pivo)

        <tr>
          <td class="align-middle"> {{ $pivo->aluno->nome_aluno }} </td>
          <td class="align-middle"> {{ $pivo->edital->titulo_edital }} </td>
          <td class="align-middle">{{date_format(date_create($pivo->data_inicio), "d/m/Y")}}</td>
          <td class="align-middle">{{date_format(date_create($pivo->data_fim), "d/m/Y")}}</td>
          <td class="align-middle">
            <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$pivo->aluno->id}}" data-bs-id="{{$pivo->aluno->id}}">
              <img src="{{asset('images/information.svg')}}" title="Informações" alt="Info aluno" style="height: 30px; width: 30px;">
            </a>
            {{-- <a type="button" href="{{ route('edital.editar_vinculo', ['aluno_id' => $pivo->aluno_id, 'edital_id' => $pivo->edital_id]) }}">
            <img src="{{asset('images/edit-outline-blue.png')}}" alt="Editar vinculo" style="height: 30px; width: 30px;">
            </a>--}}
            {{--<a type="button" href="{{ route('edital.aluno.delete', ['id' => $pivo->id]) }}">
            <img src="{{asset('images/delete.png')}}" alt="Deletar aluno" style="height: 30px; width: 30px;">
            </a>--}}
            {{--<a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents{{$pivo->aluno->id}}">
            <img src="{{asset('images/document.png')}}" alt="Documento aluno" style="height: 30px; width: 30px;">
            </a>--}}
            {{-- <a href="{{ route('termo_aluno.download', ['fileName' => $pivo->aluno->termo_compromisso_aluno]) }}">Baixar PDF</a> --}}
          </td>
        </tr>
        @include('Orientador.components_alunos.modal_legenda')
        <!-- Modal show -->
        @include('Orientador.components_alunos.modal_show')
        <!-- Modal delete-->
        @include('Orientador.components_alunos.modal_delete')
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
  function exibirModalDeletar(id) {
    $('#modal_delete_' + id).modal('show');
  }

  function exibirModalVisualizar(id) {
    $('#modal_show_' + id).modal('show');
  }
</script>


@endsection