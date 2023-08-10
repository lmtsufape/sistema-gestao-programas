@extends("templates.app")

@section("body")



@canany(['admin', 'servidor', 'gestor'])
  <div class="container-fluid">
    @if (session('sucesso'))
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
    @endif
    <br>


    <div style="display: flex; justify-content: space-evenly; align-items: center;">
      <h1 class = "titulo"><strong>Estudantes</strong></h1>
    </div>
    {{-- <div style="display: flex; justify-content: space-evenly; align-items: center; margin-bottom: 20px;"> --}}
        <form action="{{route('alunos.index')}}" method="GET">
            <input class="busca" type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor">
            <input class="lupa" type="submit" value="">
        </form>

        <a class="cadastrar-botao btn btn-primary" href="{{route("alunos.create")}}">
            Cadastrar estudantes
        </a>

    {{-- </div> --}}
    <br>
    <br>

    @if (sizeof($alunos) == 0)
      <div class="empty">
        <p>
          Não há alunos cadastrados
        </p>
      </div>
    @else

    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
         <table class="table">
          <thead>
            <tr class= table-head>
                <th scope="col" class="text-center" >Nome</th>
                <th scope="col" class="text-center">Nome Social</th>
                <th scope="col" class="text-center">CPF</th>
                <th scope="col" class="text-center">Curso</th>
                <th class="text-center">Ações</th>
            </tr>
          </thead>
          @foreach ($alunos as $aluno)
          <tbody>
                <tr>
                  <td class="align-middle">{{$aluno->user->name}}</td>
                  <td class="align-middle">{{$aluno->user->name_social}}</td>
                  <td class="align-middle">{{$aluno->cpf}}</td>
                  <td class="align-middle">{{$aluno->curso->nome}}</td>
                  <td class="align-middle">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#modal_edit_{{$aluno->id}}">
                            <img src="{{asset('images/information.svg')}}" alt="Info aluno" style="height: 30px; width: 30px;">
                        </a>

                        {{--<a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$aluno->id}}">
                            <img src="{{asset('images/document.png')}}" alt="Documento aluno"  style="height: 30px; width: 30px;">
                        </a>--}}

                        <a href=" {{route('alunos.edit', ['id' => $aluno->id] )}}">
                            <img src="{{asset('images/pencil.svg')}}" alt="Editar aluno" style="height: 30px; width: 30px;">
                        </a>

                        <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$aluno->id}}">
                            <img src="{{asset('images/delete.svg')}}" alt="Deletar aluno" style="height: 30px; width: 30px;">
                        </a>


                  </td>
                </tr>
                <tr></tr>
                @include("Alunos.components.modal_show", ["aluno" => $aluno])
                @include("Alunos.components.modal_delete", ["aluno" => $aluno])
              @endforeach
          </tbody>
        </table>

        </div>
<!--
        <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
                <div style="align-self: center; margin-right: auto">
                    <br>
                    <h4 class="fw-bold"style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
                </div>

          <div style="align-self: center; margin-right: auto">
            <div style="display: flex; margin: 10px">
              <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Informações</p>
            </div>
            {{--  <div style="display: flex; margin: 10px">
              <a><img src="/images/document.png" alt="Documentos" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Documentos</p>
            </div>  --}}

          </div>

          <div style="align-self: center; margin-right: auto">
            <div style="display: flex; margin: 10px">
              <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Editar</p>
            </div>
            <div style="display: flex; margin: 10px">
              <a><img src="{{asset('images/delete.png')}}" alt="Deletar aluno" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
            </div>
            <div style="display: flex; margin: 10px">
              <a><img src="{{asset('images/searchicon.png')}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Pesquisar</p>
            </div>
          </div>
            -->
        </div>
      </div>

  </div>
  </div>
  <br>
  <br>
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

   <!--Exibindo erros de validacao ao criar -->
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

   <!--Exibindo erros de validacao ao editar -->
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

@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url('/login')}}">Voltar</a>
@endcan
@endsection
