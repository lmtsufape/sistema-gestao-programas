@extends("templates.app")

@section("body")

  @can('servidor')
  <div class="container">
    @if (session('sucesso'))
    <div class="alert alert-danger">
        {{session('sucesso')}}
    </div>
    @endif
    <br>
    <h1><strong>Disciplinas</strong></h1>
    {{--  TODO: Falta adicionar um modal com os possiveis filtros  --}}
    <form action="{{route("disciplinas.index")}}" method="GET">
      <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor"/>
      <input type="submit" value=""/>
    </form>
  </div>

    @if (sizeof($disciplinas) == 0)
      <div class="empty">
        <p>
          Não há disciplinas cadastradas
        </p>
      </div>
    @else
    <br>
      <div">
        <table class="table" style="background-color: #F2F2F2; ">
          <thead>
          <tr>
            <th scope="col" style="border-right: 1px solid #d3d3d3;">Nome</th>
            <th scope="col">Ações</th>
          </tr>
          </thead>
          @foreach ($disciplinas as $disciplinas)
          <tbody>
                <tr> 
                  <td >{{$disciplinas->nome}}</td>
                  <td>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$disciplinas->id}}">
                      <img src="{{asset("images/info.png")}}" alt="Info programa">
                    </a>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$disciplinas->id}}">
                      <img src="{{asset("images/document.png")}}" alt="Documento programa">
                      {{--  TODO: Fica pra fazer o modal depois  --}}
                    </a>
                    <a href="{{url("/disciplinas/$disciplinas->id/edit")}}">
                      <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar programa">
                    </a>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$disciplinas->id}}">
                      <img src="{{asset("images/delete.png")}}" alt="Deletar programa">
                    </a>                                     
                  </td>
                </tr>
                @include("Disciplina.components.modal_show", ["disciplina" => $disciplinas])
                @include("Disciplina.components.modal_delete", ["disciplina" => $disciplinas])
              @endforeach
          </tbody>
      </div>

  </div>
    @endif
  </div>

  <script type="text/javascript">
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

  @elsecan('orientador')
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{route('home')}}">Voltar</a>
  @else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
  @endcan
@endsection