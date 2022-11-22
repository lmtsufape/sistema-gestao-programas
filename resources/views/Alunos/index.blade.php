@extends("templates.app")

@section("body")

  @can('servidor')
  <div class="container">
    <h1><strong>Alunos</strong></h1>
    {{--  <a type="button" data-bs-toggle="modal" data-bs-target="#modal_create">
      <img src="{{asset("images/add-icon.png")}}" class="add-button" alt="Adicionar aluno">
    </a>  --}}
    <hr>
    
  <div style="background-color: #34A853; border-radius: 45px; padding-left: 2%; padding-right: 2%; display: flex">
    <div style="align-self: center; margin-right: auto">
      <h4>Legenda</h4>
      <h5>dos icones:</h5>
    </div>
    <div style="display: flex; align-self: center; margin-right: auto">
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
     <table class="table">
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Situação</th>
        <th scope="col">Programa</th>
        <th scope="col">Ações</th>
      </tr>
      @foreach ($alunos as $aluno)
            <tr>
              <td>{{$aluno->nome}}</td>
              <td></td>
              <td></td>
              <td>
                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_edit_{{$aluno->id}}">
                  <img src="{{asset("images/info.png")}}" alt="Info aluno">
                </a>
                <a type="button" data-bs-toggle="modal" data-bs-target="">
                  <img src="{{asset("images/document.png")}}" alt="Documento aluno">
                </a>
                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$aluno->id}}">
                  <img src="{{asset("images/delete.png")}}" alt="Deletar aluno">
                </a>
                
              </td>
            </tr>
            @include("Alunos.components.modal_edit", ["aluno" => $aluno])
            @include("Alunos.components.modal_delete", ["aluno" => $aluno])
          @endforeach
     </table>
      {{--  <div id="list">  --}}
      {{--  @foreach ($alunos as $aluno)  --}}
          {{--  <div class="row justify-content-md-center listing-card">
            <div class="col-md-9 col-lg-9 informacoes">
              <a type="button" class="ver" style="text-decoration: none; color: black;" onclick="exibirModalVisualizar({{$aluno->id}})">
                <label class="labelIndex">{{$aluno->user->name}}</label>
                <hr class="labelIndex">
                <label class="labelIndex">Curso: {{$aluno->curso}}</label>
              </a>
            </div>
            <div class="col-md-2 col-lg-2 opcoes row">
              <a type="button" class="col-md-auto edit" onclick="exibirModalEditar({{$aluno->id}})">
                <img src="{{asset("images/editar.png")}}" class="option-button" alt="Editar aluno">
              </a>
              <a type="button" class="col-md-auto delete" onclick="exibirModalDeletar({{$aluno->id}})">
                <img src="{{asset("images/excluir.png")}}" class="option-button" alt="Excluir aluno">
              </a>
            </div>
          </div>  --}}
          {{--  <br>  --}}
        {{--  @include("Alunos.components.modal_edit", ['aluno' => $aluno])
        @include("Alunos.components.modal_show")
        @include("Alunos.components.modal_delete")
      @endforeach  --}}
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

