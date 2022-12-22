@extends("templates.app")
@section("body")
@can('servidor')
<div class="container" style="font-family: 'Roboto', sans-serif;">
  @if (session('sucesso'))
  <div class="alert alert-danger">
    {{session('sucesso')}}
  </div>
  @endif
  <br>
  <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
    <h1><strong>Servidores</strong></h1>
    <div style="margin: auto"></div>
    {{-- TODO: Falta adicionar um modal com os possiveis filtros  --}}
    <form action="{{route("servidores.index")}}" method="GET" id="myForm">
      <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              background-position: 10px 2px;
              background-repeat: no-repeat;
              width: 35%;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              margin-bottom: 12px;
              margin-right: 12px;">
      <input type="submit" value="" style="background-image: url('/images/searchicon.png');
              background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              width: 50px;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              position: absolute;
              margin: auto;" />
    </form>
  </div>
  <div  style="display: contents; align-content: center; align-items: center">
    <a style="background: #2D3875; border-radius: 25px; border: #2D3875; color: #f0f0f0; font-style: normal;
      font-weight: 400; font-size: 15px; text-decoration: none; line-height: 28px; padding: 9px; align-content: center; align-items: center; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" href="{{route('servidores.create')}}">
      <img src="{{asset("images/plus.png")}}" alt="Cadastrar servidor" style="padding-bottom: 5px; width: 20px;"> Cadastrar servidor
    </a>
  </div>

 

  @if (sizeof($servidores) == 0)
  <div class="empty">
    <p>
      Não há servidores cadastrados
    </p>
  </div>
  @else
  <br>
  <div class="row p-5" style="display: flex; justify-content:center;">
    <div class="col-10">
      <div class="table-responsive" style="border: 1px solid #d3d3d3; border-radius: 15px; padding: 15px; background: #F2F2F2; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <table class="table" style="background-color: #F2F2F2; ">
          <thead>
            <tr>
              <th scope="col" style="border-right: 1px solid #d3d3d3;">Nome</th>
              <th scope="col" style="border-right: 1px solid #d3d3d3;">Email</th>
              <th scope="col" style="border-right: 1px solid #d3d3d3;">CPF</th>
              <th scope="col" style="border-right: 1px solid #d3d3d3;">Tipo do servidor</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          @foreach ($servidores as $servidor)
          <tbody>
            <tr>
              <td class="item" style="border-right: 1px solid #d3d3d3;">{{$servidor->user->name}}</td>
              <td class="item" style="border-right: 1px solid #d3d3d3;">{{$servidor->user->email}}</td>
              <td class="item" style="border-right: 1px solid #d3d3d3;">{{$servidor->cpf}}</td>
              <td class="item" style="border-right: 1px solid #d3d3d3;">{{$servidor->tipo_servidor}}</td>
              <td>
                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$servidor->id}}">
                  <img src="{{asset("images/info.png")}}" alt="Info servidor">
                </a>
                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$servidor->id}}">
                  <img src="{{asset("images/document.png")}}" alt="Documento servidor">
                  {{-- TODO: Fica pra fazer o modal depois  --}}
                </a>
                <a href="{{url("/servidores/$servidor->id/edit")}}">
                  <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar servidor">
                </a>
                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$servidor->id}}">
                  <img src="{{asset("images/delete.png")}}" alt="Deletar servidor">
                </a>
              </td>
            </tr>
            @include("servidores.components.modal_show", ["servidor" => $servidor])
            @include("servidores.components.modal_delete", ["servidor" => $servidor])
            @endforeach
          </tbody>
        </table>
      </div>
        {{--  TODO: A tabela tem que limitar para aparecer x usuarios em cada página, e a paginação mudar o ultimo númerode acordo com o tanto de páginas que tem disponiveis para olhar  --}}   
      <div style="margin: auto; padding: 10px; justify-content:center;">
        <div class="pagination" style="display: flex; justify-content: center;">
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Anterior</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">1</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">2</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">3</a>
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Próximo</a>
        </div>
      </div>
      @endif
    </div>
    <div class="col-2">
      <div style="background-color: #F2F2F2; border-radius: 15px; width:150px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); display: flex; justify-content: center; ">
        <div class="text-start p-3 align-items-center">
          <div class="text-center pb-3" >
            <h4 style="font-size:15px;"><strong> Legenda dos icones: </strong></h4>
          </div>
          <div style="justify-content: center;">
            <div style=" margin-bottom: 10px; ">
              <a style="font-style:normal; font-weight: 400; font-size: 15px; line-height: 130%; "><img src="{{asset("images/searchicon.png")}}" alt="Procurar" style="width: 20px; margin-right:5px;">Pesquisar</a>
            </div>
            <div style=" margin-bottom: 10px">
              <a style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; "><img src="/images/info.png" alt="Informacoes" style="width: 20px; margin-right:5px;">Informações</a>
            </div>
            <div style=" margin-bottom: 10px">
              <a style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%;"><img src="/images/document.png" alt="Documentos" style="width: 20px; margin-right:5px;">Documentos</a>
            </div>
            <div style=" margin-bottom: 10px">
              <a style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%;"><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; margin-right:5px;">Editar</a>
            </div>
            <div style=" margin-bottom: 10px">
              <a style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; "><img src="{{asset("images/delete.png")}}" alt="Deletar aluno" style="width: 20px; margin-right:5px;">Deletar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
  $document.ready(function() {
    $("#example").DataTable();
  })
</script>

<script type="text/javascript">
  function exibirModalDeletar(id) {
    $('#modal_delete_' + id).modal('show');
  }

  function exibirModalVisualizar(id) {
    $('#modal_show_' + id).modal('show');
  }
</script>

<style>
  pagination {
    display: flex;
    justify-content: center;
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
  ::-webkit-input-placeholder {
  text-align: center;
  }

</style>

@elsecan('servidor')
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{route('home')}}">Voltar</a>
@else
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection