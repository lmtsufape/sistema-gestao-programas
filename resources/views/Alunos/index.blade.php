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


  @can('servidor')
  <div class="container">
    <div style="margin-bottom: 10px; display: flex; gap: 20px; margin-top: 20px">
    <h1><strong>Alunos</strong></h1>
    <div style="margin: auto"></div>
    {{--  TODO: Falta adicionar um modal com os possiveis filtros  --}}
    <button style="background-color: #D9D9D9; border-radius: 30px; height: 45px;
    border: 1px solid #ddd; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> 
    <a><img src="/images/filtraricon.png" alt="Documentos"></a>
    </button>
    <input type="text" onkeyup="" placeholder="Buscar" title="Barra de pesquisa" 
    style="background-image: url('/images/searchicon.png'); 
          background-color: #D9D9D9;
          border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
          background-position: 10px 2px;
          background-repeat: no-repeat;
          width: 35%;
          font-size: 16px;
          height: 45px;
          border: 1px solid #ddd;
          margin-bottom: 12px;">
    </div>
    {{--  <a type="button" data-bs-toggle="modal" data-bs-target="#modal_create">
      <img src="{{asset("images/add-icon.png")}}" class="add-button" alt="Adicionar aluno">
    </a>  --}}
     
    
    
    <div style="background-color: #34A853; border-radius: 45px; padding-left: 2%; padding-right: 2%;
     display: flex; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
      <div style="align-self: center; margin-right: auto">
        <h4>Legenda</h4>
        <h5>dos icones:</h5>
      </div>
      <div style="display: flex; align-self: center; margin-right: auto">
        <div style="display: flex; margin: 10px">
          <a><img src="{{asset("images/filtraricon.png")}}" alt="Botao filtrar"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 20px; line-height: 130%; margin:5px">Filtrar</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="{{asset("images/searchicon.png")}}" alt="Procurar"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 20px; line-height: 130%; margin:5px">Pesquisar</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="/images/info.png" alt="Editar" style="size: 60px"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 20px; line-height: 130%; margin:5px">Editar</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="/images/document.png" alt="Documentos" style="size: 60px"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 20px; line-height: 130%; margin:5px">Documentos</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="{{asset("images/delete.png")}}" alt="Deletar aluno"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 20px; line-height: 130%; margin:5px">Deletar</p>
        </div>
      </div>
    </div>

    @include("Alunos.components.modal_create")
  
    @if (sizeof($alunos) == 0)
      <div class="empty">
        <p>
          Não há alunos cadastrados
        </p>
      </div>
    @else
    <br>
      <div style="border: 1px solid #d3d3d3; border-radius: 45px; padding: 15px; background: #F2F2F2; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
{{--  TODO: Arrumar um jeito da table ser sortable  --}}
        <table class="table" style="background-color: #F2F2F2; ">
          <thead>
          <tr>
            <th scope="col" style="border-right: 1px solid #d3d3d3;">Nome</th>
            <th scope="col" style="border-right: 1px solid #d3d3d3;">Situação</th>
            <th scope="col" style="border-right: 1px solid #d3d3d3;">Programa</th>
            <th scope="col">Ações</th>
          </tr>
          </thead>
          @foreach ($alunos as $aluno)
          <tbody>
                <tr> 
                  <td style="border-right: 1px solid #d3d3d3;">{{$aluno->nome}}</td>
                  <td style="border-right: 1px solid #d3d3d3;"></td>
                  <td style="border-right: 1px solid #d3d3d3;"></td>
                  <td>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_edit_{{$aluno->id}}">
                      <img src="{{asset("images/info.png")}}" alt="Info aluno">
                    </a>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$aluno->id}}">
                      <img src="{{asset("images/document.png")}}" alt="Documento aluno">
                      {{--  TODO: Fica pra fazer o modal depois  --}}
                    </a>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$aluno->id}}">
                      <img src="{{asset("images/delete.png")}}" alt="Deletar aluno">
                    </a>
                    
                  </td>
                </tr>
                @include("Alunos.components.modal_edit", ["aluno" => $aluno])
                @include("Alunos.components.modal_delete", ["aluno" => $aluno])
              @endforeach
          </tbody>
        </table>
{{--  TODO: A tabela tem que limitar para aparecer x usuarios em cada página, e a paginação mudar o ultimo número
  de acordo com o tanto de páginas que tem disponiveis para olhar  --}}
      </div>
      <div style="margin: auto; width: 45%; padding: 10px;">
        <div class="pagination">
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Anterior</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">1</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">2</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">3</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">4</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">...</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">15</a>
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Próximo</a>
        </div>
      </div>
     
  </div>
    @endif
  </div>

  <script type="text/javascript">

    function exibirModalEditar(id){
      $('#modal_edit_' + id).modal('show');
    }

    function exibirModalDeletar(id){
      $('#modal_delete_' + id).modal('show');
    }

    function exibirModalVisualizar(id){
      $('#modal_show_' + id).modal('show');
    }
  </script>

  <!-- Exibindo erros de validacao ao criar -->
 @if(count($errors->create) > 0)
  <script type="text/javascript">
    $(function () {
      // Bloqueando o usuario na tela de modal apos falha na validacao.
      // Forcando ele a clicar no botao de fechar, para limpar os erros
      $("#modal_create").modal({backdrop:"static", keyboard:false});
      $("#modal_create").modal('show');
    });
  </script>
  @endif

  <!-- Exibindo erros de validacao ao editar -->
  @if(count($errors->update) > 0)
  <script type="text/javascript">
    $(function () {
      // Bloqueando o usuario na tela de modal apos falha na validacao.
      // Forcando ele a clicar no botao de fechar, para limpar os erros
      $("#modal_edit_{{old( 'id' )}}").modal({backdrop:"static", keyboard:false});
      $("#modal_edit_{{old( 'id' )}}").modal('show');
    });
  </script>
  @endif
  
  @elsecan('aluno')
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{route("vinculos.index")}}">Voltar</a>
  @else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
  @endcan
@endsection

