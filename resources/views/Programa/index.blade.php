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

  .textolegenda {
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 130%;
    margin: 5px
  }
</style>


@canany(['admin', 'pro_reitor'])
<div class="container">
  @if (session('sucesso'))
  <div class="alert alert-success">
    {{session('sucesso')}}
  </div>
  @endif
  <br>

  <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
    <h1 style="color:#2D3875;"><strong>Programas</strong></h1>
    <div style="margin: auto"></div>
    <form action="{{route("programas.index")}}" method="GET">
      <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              background-position: 10px 2px;
              background-repeat: no-repeat;
              width: 35%;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              margin-bottom: 12px;  margin-right: 10px">
          
          <input type=" submit" value="" style="background-image: url('/images/searchicon.png');
              background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              width: 40px;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              position: absolute;
              margin: auto;" />
    </form>
  </div>

  <div style="display: contents; align-content: center; align-items: center;">
    <a style="background:#34A853; border-radius: 25px; border: #2D3875; color: #f0f0f0; font-style: normal;
      font-weight: 400; font-size: 20px; line-height: 28px; padding-top: 4px; padding-bottom: 4px; align-content: center;
      align-items: center; padding-right: 15px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none;
      padding-left: 10px;" href="{{route("programas.create")}}">
      <img src="{{asset("images/plus.png")}}" alt="Cadastrar programa" style="padding-bottom: 5px"> Cadastrar programa
    </a>
    <br>
    <br>
  </div>
  @if (sizeof($programas) == 0)
  <div class="empty">
    <p>
      Não há programas cadastrados
    </p>
  </div>
  @else
  <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
      <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
        min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        @foreach ($programas as $programas)
        <tbody>
          <tr>
            <td class="align-middle"> {{$programas->nome}} </td>
            <td class="align-middle"> {{$programas->descricao}} </td>
            <td class="align-middle">
              <!-- <a style="padding:2px" href="{{url("/programas/$programas->id/alunos")}}">
                <img src="{{asset("images/bx_user.png")}}" alt="Listar alunos">
              </a> -->
              <a style="padding:2px" href="{{url("/programas/$programas->id/editais")}}">
                <img src="{{asset("images/listaredital.png")}}" alt="Listar edital">
              </a>
              <a style="padding:2px" type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$programas->id}}">
                <img src="{{asset("images/info.png")}}" alt="Info programa">
              </a>
              <a style="padding:2px" href="{{url("/programas/$programas->id/edit")}}">
                <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar programa">
              </a>
              <a style="padding:2px" type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$programas->id}}">
                <img src="{{asset("images/delete.png")}}" alt="Deletar programa">
              </a>
            </td>
          </tr>
          <tr>
            {{-- Não apagar esse tr vazio senão a linha da tabela fica mt preta/grossa  --}}
          </tr>
          @include("Programa.components.modal_show", ["programa" => $programas, "programa_servidor" => $programa_servidor, "servidors" => $servidors, "users" => $users])
          @include("Programa.components.modal_delete", ["programa" => $programas])
          @endforeach
        </tbody>
      </table>


    </div>

    <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
      <div style="align-self: center; margin-right: auto">
        <br>
        <h4 class="fw-bold" style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
      </div>

      <div style="align-self: center; margin-right: auto">
        <div style="display: flex; margin: 10px">
          <a><img src="{{asset("images/searchicon.png")}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
          <p class="textolegenda">Pesquisar</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
          <p class="textolegenda">Informações</p>
        </div>
        <div style="align-self: center; margin-right: auto">
          <div style="display: flex; margin: 10px">
            <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
            <p class="textolegenda">Editar</p>
          </div>
          <div style="display: flex; margin: 10px">
            <a><img src="{{asset("images/delete.png")}}" alt="Deletar aluno" style="width: 20px; height: 20px;"></a>
            <p class="textolegenda">Deletar</p>
          </div>
        </div>
        <div style="align-self: center; margin-right: auto">
          <div style="display: flex; margin: 10px">
            <a><img src="/images/listaredital.png" alt="Listar editais" style="width: 20px; height: 20px;"></a>
            <p class="textolegenda">Listar Edital</p>
          </div>
        </div>
        <!-- <div style="align-self: center; margin-right: auto">
          <div style="display: flex; margin: 10px">
            <a><img src="/images/bx_user.png" alt="Listar alunos" style="width: 20px; height: 20px;"></a>
            <p class="textolegenda">Listar Alunos</p>
          </div>
        </div> -->
      </div>

    </div>

  </div>
</div>
<br>
@endif
</div>

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