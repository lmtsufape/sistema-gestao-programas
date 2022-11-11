@extends("templates.app")

@section("body")
  @can('servidor')
  <div class="container">
    <h1><strong>Professores</strong></h1>
    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_create">
      <img src="{{asset("images/add-icon.png")}}" class="add-button" alt="Adicionar Professor">
    </a>
  
    @include("professores.componentes.modal_create")
  
    @if (sizeof($professors) == 0)
      <div class="empty">
        <p>
          Não há professores cadastrados
        </p>
      </div>
    @else
      <div id="list">
        @foreach ($professors as $professor)
          <div class="row justify-content-md-center listing-card">
            <div class="col-md-6 col-lg-6 informacoes">
              <a type="button" class="ver" style="text-decoration: none; color: black;" onclick="exibirModalVisualizar({{$professor->id}})">
                <label class="labelIndex">{{$professor->nome}}</label>
                <hr class="labelIndex">
                <label class="labelIndex">SIAPE: {{$professor->siape}}</label>
              </a>
            </div>
            <div class="col-md-4 col-lg-4 opcoes">
              <a type="button" class="edit" onclick="exibirModalEditar({{$professor->id}})">
                <img src="{{asset("images/editar.png")}}" class="option-button" alt="Editar Professor">
              </a>
              <a type="button" class="delete" onclick="exibirModalDeletar({{$professor->id}})">
                <img src="{{asset("images/excluir.png")}}" class="option-button" alt="Excluir Professor">
              </a>
            </div>
          </div>
          <br>
          @include("professores.componentes.modal_edit", ['professor' => $professor])
          @include("professores.componentes.modal_show")
          @include("professores.componentes.modal_delete")
        @endforeach   
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
      $("#modal_edit_{{old('id')}}").modal({backdrop:"static", keyboard:false});
      $("#modal_edit_{{old('id')}}").modal('show');
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
 