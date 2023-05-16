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

<div class="container" style="font-family: 'Roboto', sans-serif;">
  @if (session('sucesso'))
  <div class="alert alert-success">
    {{session('sucesso')}}
  </div>
  @endif
  <br>
  
  <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
    <h1 style="color:#2D3875;"><strong>Editais</strong></h1>
    <div style="margin: auto"></div>
    <form action="{{  route('edital.index')  }}" method="GET">
      <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
                  border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                  background-position: 10px 2px;
                  background-repeat: no-repeat;
                  width: 35%; align-items: center;
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
  <div style="justify-content: center; ">
    <div style="display: contents; align-content: center; align-items: center;">
      <a style="background:#34A853; border-radius: 25px; border: #2D3875; color: #f0f0f0; font-style: normal;
      font-weight: 400; font-size: 20px; line-height: 28px; padding-top: 4px; padding-bottom: 4px; align-content: center;
      align-items: center; padding-right: 15px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none;
      padding-left: 10px;margin-right:10px;" href="{{route("edital.create")}}">
        <img src="{{asset("images/plus.png")}}" alt="Cadastrar edital" style="padding-bottom: 3px"> Cadastrar Edital
      </a>
    </div>
  </div>
  <br>
  <br>
  <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
      <table class="table" style="border-radius: 15px; background-color: #F2F2F2; min-width: 600px; box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25)
        ;margin-bottom: 5px; min-height: 50px">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Data de início</th>
            <th scope="col">Data de fim</th>
            <th scope="col">Programa</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($editais as $edital)
          <tr>
            <td style="border-right: 1px solid #d3d3d3;">{{ $edital->titulo_edital}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{date_format(date_create($edital->data_inicio), "d/m/Y")}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{date_format(date_create($edital->data_fim), "d/m/Y")}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{$edital->programa->nome}}</td>
            <td>
              <!-- <a style="padding:2px" href="{{  route('edital.vinculo', ['id' => $edital->id]) }}">
                <img src="{{asset("images/bx_user.png")}}" alt="Listar alunos">
              </a> -->
              <a href="{{route('edital.show', ['id' => $edital->id]  )}}">
                <img src="{{asset("images/vinculo_edital.png")}}" alt="Vincular aluno" style="height: 30px; width: 30px;">
              </a>
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{$edital->id}}">
                <img src="{{asset("images/info.png")}}" alt="Info edital" style="height: 30px; width: 30px;">
              </a>
              <a type="button" href="{{  route('edital.edit', ['id' => $edital->id] )  }}">
                <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar edital" style="height: 30px; width: 30px;">
              </a>
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$edital->id}}">
                <img src="{{asset("images/delete.png")}}" alt="Deletar edital" style="height: 30px; width: 30px;">
              </a>
            </td>
          </tr>
          <tr>
            {{-- Não apagar esse tr  --}}
          </tr>
        </tbody>
        @include("Edital.components.modal_show", ["edital" => $edital, "orientadors" => $orientadors])
        @include("Edital.components.modal_delete", ["edital" => $edital])
        @endforeach
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
        <div style="align-self: center; margin-right: auto">
          <div style="display: flex; margin: 10px">
            <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Editar</p>
          </div>
          <div style="display: flex; margin: 10px">
            <a><img src="{{asset("images/delete.png")}}" alt="Deletar orientador" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
          </div>
          <!-- <div style="display: flex; margin: 10px">
            <a><img src="{{asset("images/bx_user.png")}}" alt="Listar editais" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:4px">Listar alunos</p>
          </div> -->
          <div style="display: flex; margin: 10px">
            <a><img src="{{asset("images/vinculo_edital.png")}}" alt="Vincular aluno" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:4px">Vincular aluno</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
</div>


<script type="text/javascript">
  function exibirModalDeletar(id) {
    $('#modal_delete_' + id).modal('show');
  }

  function exibirModalVisualizar(id) {
    $('#modal_show' + id).modal('show');
  }
</script>

@else
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan

@endsection