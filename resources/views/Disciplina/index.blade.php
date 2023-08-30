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
      <h1 class = "titulo"><strong>Disciplinas</strong></h1>
    </div>

    <form class="search-container" action="{{route("disciplinas.index")}}" method="GET">
        <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
        <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
        <button class="cadastrar-botao" type="button" onclick="window.location.href = '{{ route("disciplinas.create") }}'">Cadastrar disciplina</button>
    </form>

    <br>
    <br>

  @if (sizeof($disciplinas) == 0)
  <div class="empty">
    <p>
      Não há disciplinas cadastradas
    </p>
  </div>
  @else

  <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
      <table class="table">
        <thead>
          <tr class="table-head">
            <th scope="col" class="text-center">Nome</th>
            <th scope="col" class="text-center">Curso</th>
            <th class="text-center">
                Ações
                <button type="button" class="infobutton" data-bs-toggle="modal" data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
                    <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda" style="height: 20px; width: 20px;">
                </button>
            </th>
          </tr>
        </thead>
        @foreach ($disciplinas as $disciplinas)
        <tbody>
          <tr>
            <td class="align-middle">{{$disciplinas->nome}}</td>
            <td class="align-middle">{{$disciplinas->curso->nome}}</td>
            <td class="align-middle">
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$disciplinas->id}}">
                <img src="{{asset('images/information.svg')}}" title="Informações" alt="Info programa" style="height: 30px; width: 30px;">
              </a>
              <a href="{{url("/disciplinas/$disciplinas->id/edit")}}">
                <img src="{{asset('images/pencil.svg')}}" title="Editar" alt="Editar programa" style="height: 30px; width: 30px;">
              </a>
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$disciplinas->id}}">
                <img src="{{asset('images/delete.svg')}}"title="Remover" alt="Deletar programa" style="height: 30px; width: 30px;">
              </a>
            </td>
          </tr>
        </tbody>
        @include("Disciplina.components.modal_show", ["disciplina" => $disciplinas])
        @include("Disciplina.components.modal_delete", ["disciplina" => $disciplinas])
        @include("Disciplina.components.modal_legenda")
        @endforeach
      </table>
    </div>
    <!--
    <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
      <div style="align-self: center; margin-right: auto">
        <br>
        <h4 class="fw-bold" style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
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
          <a><img src="{{asset("images/delete.png")}}" alt="Deletar aluno" style="width: 20px; height: 20px;"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="{{asset("images/searchicon.png")}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Pesquisar</p>
        </div>
      </div>
    </div>
        -->
  </div>
</div>
@endif


<script type="text/javascript">
  function exibirModalDeletar(id) {
    $('#modal_delete_' + id).modal('show');
  }

  function exibirModalVisualizar(id) {
    $('#modal_show_' + id).modal('show');
  }
</script>

<!-- Exibindo erros de validacao ao criar -->
@if(count($errors->create) > 0)
<script type="text/javascript">
  $(function() {
    // Bloqueando o usuario na tela de modal apos falha na validacao.
    // Forcando ele a clicar no botao de fechar, para limpar os erros
    $("#modal_create").modal({
      backdrop: "static",
      keyboard: false
    });
    $("#modal_create").modal('show');
  });
</script>
@endif

<!-- Exibindo erros de validacao ao editar -->
@if(count($errors->update) > 0)
<script type="text/javascript">
  $(function() {
    // Bloqueando o usuario na tela de modal apos falha na validacao.
    // Forcando ele a clicar no botao de fechar, para limpar os erros
    $("#modal_edit_{{old( 'id' )}}").modal({
      backdrop: "static",
      keyboard: false
    });
    $("#modal_edit_{{old( 'id' )}}").modal('show');
  });
</script>
@endif

@else
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection
