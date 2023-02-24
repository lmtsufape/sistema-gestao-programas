@extends("templates.app")
@section("body")
@canany(['admin', 'pro_reitor'])
  <div class="container" style="font-family: 'Roboto', sans-serif;">
    @if (session('sucesso'))
    <div class="alert alert-success">
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
    <div style="display: contents; align-content: center; align-items: center;">
      <a style="background: #2D3875; border-radius: 25px; border: #2D3875; color: #f0f0f0; font-style: normal;
      font-weight: 400; font-size: 24px; line-height: 28px; padding-top: 6px; padding-bottom: 6px; align-content: center;
      align-items: center; padding-right: 15px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none;
      padding-left: 10px;" href="{{route('servidores.create')}}">
      <img src="{{asset("images/plus.png")}}" alt="Cadastrar servidor" style="padding-bottom: 5px;"> Cadastrar servidor
      </a>
      <br>
    </div>

    @if (sizeof($servidores) == 0)
    <div class="empty">
      <p>
        Não há servidores cadastrados
      </p>
    </div>
    @else
    <br>
    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
      <div class="col-md-9 corpo p-2 px-3">
      <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
      min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
          <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            <th scope="col">Tipo do servidor</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        @foreach ($servidores as $servidor)
        <tbody>
          <tr>
            <td class="align-middle">{{$servidor->user->name}}</td>
              <td class="align-middle">{{$servidor->user->email}}</td>
              <td class="align-middle">{{$servidor->cpf}}</td>
              <td class="align-middle">{{$servidor->tipo_servidor->nome}}</td>
              <td class="align-middle">
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
      <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
          width: 150px; height: 50%;">
                  <div style="align-self: center; margin-right: auto">
                      <br>
                      <h4 style="font-size: 15px">Legenda dos ícones:</h4>
                  </div>
        <div style="align-self: center; margin-right: auto">
          <div style="display: flex; margin: 10px">
            <a><img src="{{asset("images/searchicon.png")}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Pesquisar</p>
          </div>
          <div style="display: flex; margin: 10px">
            <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Informações</p>
          </div>
          <div style="display: flex; margin: 10px">
            <a><img src="/images/document.png" alt="Documentos" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Documentos</p>
          </div>
        </div>
        <div style="align-self: center; margin-right: auto">
          <div style="display: flex; margin: 10px">
            <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Editar</p>
          </div>
          <div style="display: flex; margin: 10px">
            <a><img src="{{asset("images/delete.png")}}" alt="Deletar aluno" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
          </div>
        </div>
      </div>
      @endif
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

@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection