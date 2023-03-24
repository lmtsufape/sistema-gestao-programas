@extends("templates.app")

@section("body")

@canany(['admin', 'servidor'])


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

<div class="container">
  @if (session('sucesso'))
  <div class="alert alert-success">
    {{session('sucesso')}}
  </div>
  @endif
  <br>

  <div class="container">
    @if (session('sucesso'))
    @endif
    <br>
    <div style="margin-bottom: 10px;  gap: 20px;">
      <h1 style="color:#2D3875;"><strong>Cursos</strong></h1>
      <form action="{{route("cursos.index")}}" method="GET">
        <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              background-position: 10px 2px;
              background-repeat: no-repeat;
              width: 35%;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              margin-bottom: 12px; margin-right: 10px">

        <input type="submit" value="" style="background-image: url('/images/searchicon.png');
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
        font-weight: 400; font-size: 24px; line-height: 28px; padding-top: 6px; padding-bottom: 6px; align-content: center;
        align-items: center; padding-right: 15px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none;
        padding-left: 10px;" href="{{route("cursos.create")}}">
        <img src="{{asset("images/plus.png")}}" alt="Cadastrar curso" style="padding-bottom: 5px"> Cadastrar Curso
      </a>

    </div>

    @if (sizeof($cursos) == 0)
    <div class="empty">
      <p>
        Não há cursos cadastrados
      </p>
    </div>
    @else
    @endif

    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
      <div class="col-md-9 corpo p-2 px-3">
        <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
             min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
          <thead>
            <tr>
              <th scope="col" style="border-right: 1px solid #d3d3d3;">Nome</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cursos as $cursos)
            <tr>
              <td style="border-right: 1px solid #d3d3d3;">{{$cursos->nome}}</td>
              <td>
                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$cursos->id}}">
                  <img src="{{asset("images/info.png")}}" alt="Info curso">
                </a>
                <a href="{{url("/cursos/$cursos->id/edit")}}">
                  <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar curso">
                </a>
                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$cursos->id}}">
                  <img src="{{asset("images/delete.png")}}" alt="Deletar curso">
                </a>
              </td>
            </tr>
            @include("Curso.components.modal_show", ["curso" => $cursos, "disciplinas" => $disciplinas])
            @include("Curso.components.modal_delete", ["curso" => $cursos])
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
      </div>
    </div>
    {{-- </div>
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
        </div>  --}}


  </div>
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

<script>
  $("#cursos").chosen({
    placeholder_text_multiple: "Selecione um curso",
    // max_shown_results : 5,
    no_results_text: "Não possui cursos."
  });
</script>

@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan

@endsection