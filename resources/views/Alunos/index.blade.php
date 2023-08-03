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
  .titulo{  
    color: #2D3875;
    font-size: 24px;
  }
  .busca{
    border-radius: 10px 0px 0px 10px;
    background-color: #FFF;
    background-position: 10px 2px;
    background-repeat: no-repeat;
    width: 57%;
    font-size: 16px;
    height: 4.8vh;
    border: 1px solid var(--preto-p-50, #E6E6E6);
    margin-bottom: 12px; 
    margin-right: 10px;
  }
  .lupa{
    background-image: url('/images/searchicon.png');
    border-radius: 0px 10px 10px 0px;
    background-color: #fff;
    width: 2.4%;
    font-size: 16px;
    height: 4.8vh;
    border: 1px solid var(--preto-p-50, #E6E6E6);
    position: absolute;
    margin: auto;
  }
  .cadastrar-buttom{
    display: flex;
    background: var(--green-g-200, #2B8C64); 
    border-radius: 9px; 
    border: 1px solid var(--green-g-200, #2B8C64); 
    justify-content: center;
    align-items: center;
    text-decoration: none;
    padding: 10px;
    width: 15.4%;
    height: 4.8vh;

  }
  .cadastrar{
    color: var(--tons-claros-t-50, #FEFEFE);
    font-style: normal;
    font-weight: 400; 
    font-size: 14px;
    line-height: normal;
    text-decoration: none;
  }
  .cadastrar-buttom :hover{
    text-decoration: none;
    color: white;
  }
  table{
    border-radius: 10px; 
    background-color: #F2F2F2;
    min-height: 50px;
    width: 73%;
  }
  th {
      background-color: #000;
      color: #FFFFFF;
      padding: 10px;
    }
    th, td {
      border: 0px solid #ccc;
      padding: 10px;
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #fff;
    }

</style>


@canany(['admin', 'servidor', 'gestor'])
  <div class="container">
    @if (session('sucesso'))
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
    @endif
    <br>

    <div>
      <h1 class = "titulo"><strong>Estudantes</strong></h1>
    </div>
    {{--  TODO: Falta adicionar um modal com os possiveis filtros  --}}
    <form action="{{route('alunos.index')}}" method="GET">  
    <input class = "busca" type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor">
    <input class = "lupa" type="submit" value="">
    </form>

  <div class="cadastrar-buttom">
    <a class="cadastrar"
    href="{{route("alunos.create")}}">
        Cadastrar estudantes
    </a>
    </div>
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
         <table class="table" style=" ">
          <thead>

            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Nome Social</th>
                <th scope="col">CPF</th>
                <th scope="col">Curso</th>
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
                            <img src="{{asset('images/info.png')}}" alt="Info aluno" style="height: 30px; width: 30px;">
                        </a>

                        {{--<a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$aluno->id}}">
                            <img src="{{asset('images/document.png')}}" alt="Documento aluno"  style="height: 30px; width: 30px;">
                        </a>--}}

                        <a href=" {{route('alunos.edit', ['id' => $aluno->id] )}}">
                            <img src="{{asset('images/edit-outline-blue.png')}}" alt="Editar aluno" style="height: 30px; width: 30px;">
                        </a>

                        <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$aluno->id}}">
                            <img src="{{asset('images/delete.png')}}" alt="Deletar aluno" style="height: 30px; width: 30px;">
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
