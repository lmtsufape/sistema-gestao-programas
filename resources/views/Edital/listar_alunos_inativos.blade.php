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
      <h1 class = "titulo"><strong>Estudantes Vinculados - Inativos</strong></h1>
  </div>

  <form class="search-container" action="" method="GET">
        <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
        <input class="search-button" type="submit" value=""></input>
        <button class="cadastrar-botao" type="button" onclick="window.location.href = '{{route('edital.show', ['id' => $edital->id ])}}'">Vincular Estudante</button>
    </form>

  <br>    
  <br>

 <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
      <table class="table">
        <thead>
          <tr class= "table-head">
            <th scope="col" class="text-center">Nome</th>
            <th scope="col" class="text-center">Edital</th>
            <th scope="col" class="text-center">Data de Início</th>
            <th scope="col" class="text-center">Data de Fim</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        @foreach($vinculos as $vinculo)
        <tbody>
          <tr>
            <td class="align-middle"> {{ $vinculo->aluno->nome_aluno }} </td>
            <td class="align-middle"> {{ $vinculo->edital->titulo_edital }} </td>
            <td class="align-middle">{{date_format(date_create($vinculo->data_inicio), "d/m/Y")}}</td>
            <td class="align-middle">{{date_format(date_create($vinculo->data_fim), "d/m/Y")}}</td>
            <td class="align-middle">
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$vinculo->aluno->id}}" data-bs-id="{{$vinculo->aluno->id}}">
                <img src="{{asset('images/information.svg')}}" alt="Info aluno" style="height: 30px; width: 30px;">
              </a>
              <a href="{{route('edital.ativarVinculo', ['id' => $vinculo->id]  )}}">
                <img src="{{asset('images/vincular_estudante.svg')}}" alt="Ativar Vinculo aluno" style="height: 30px; width: 30px;">
              </a>
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents{{$vinculo->aluno->id}}">
                <img src="{{asset('images/document.svg')}}" alt="Documento aluno"  style="height: 30px; width: 30px;">
              </a>
              {{-- <a href="{{ route('termo_aluno.download', ['fileName' => $vinculo->termo_compromisso_aluno]) }}">Baixar PDF</a> --}}
            </td>
          </tr>
    
          @include('Edital.components_alunos.modal_show', ['aluno' => $vinculo->aluno, 'vinculo' => $vinculo])
          @include('Edital.components_alunos.modal_documents', ['aluno' => $vinculo->aluno, 'vinculo' => $vinculo])
          @include('Edital.components_alunos.modal_delete', ['aluno' => $vinculo->aluno, 'edital' => $vinculo->edital])
        @endforeach
        </tbody>
      </table>
    </div> 
  </div>
  <br>

</div>

<script type="text/javascript">
  function exibirModalDeletar(id) {
    $('#modal_delete_' + id).modal('delete');
  }

  function exibirModalVisualizar(id) {
    $('#modal_show_' + id).modal('show');
  }

  function exibirModalDocumentos(id) {
    $('#modal_documents' + id).modal('documents');
  }
</script>


@endsection
