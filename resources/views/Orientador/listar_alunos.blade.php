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
</style>

<div class="container">
  @if (session('sucesso'))
  <div class="alert alert-success">
    {{session('sucesso')}}
  </div>
  @endif
  <br>

  <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
    <h1 style="color:#2D3875;"><strong>Meus Alunos</strong></h1>
    <div style="margin: auto"></div>
    <form action="" method="GET">
      <input class="text-center p-3" type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
                  border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                  background-position: 10px 2px;
                  background-repeat: no-repeat;
                  width: 35%;
                  font-size: 16px;
                  height: 45px;
                  border: 1px solid #ddd;
                  margin-bottom: 12px; margin-right: 10px
                  ">

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

  <!-- <div style="display: contents; align-content: center; align-items: center;">
    <a style="background:#34A853; border-radius: 25px; border: #2D3875; color: #f0f0f0; font-style: normal;
      font-weight: 400; font-size: 24px; line-height: 28px; padding-top: 6px; padding-bottom: 6px; align-content: center;
      align-items: center; padding-right: 15px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none;
      padding-left: 10px;" href="">
      <img src="{{asset("images/plus.png")}}" alt="Cadastrar aluno" style="padding-bottom: 5px"> Cadastrar Aluno
    </a>
    <br>
  </div> -->
    <br>
    
  <div style="display: flex; gap: 30px; margin: 15px 15px 15px 15px;">

    <table class="table" style="border-radius: 15px; background-color: #F2F2F2; min-width: 600px; box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25)
        ;margin-bottom: 5px; min-height: 350px">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Edital</th>
          <th scope="col">Bolsa</th>
          <th scope="col">Valor da bolsa</th>
          <th class="text-center">Ações</th>
        </tr>
      </thead>
      <tbody>
        <!-- Foreach para listar os alunos -->
        <tr>
          <td> </td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td>
            <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_">
              <img src="{{asset("images/info.png")}}" alt="Info edital" style="height: 30px; width: 30px;">
            </a>
            <!-- <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_">
              <img src="{{asset("images/delete.png")}}" alt="Deletar edital" style="height: 30px; width: 30px;">
            </a> -->
          </td>
        </tr>

        <!-- Modal show -->
        @include('Orientador.components_alunos.modal_show')
        <!-- Modal delete-->
        @include('Orientador.components_alunos.modal_delete')


        <!-- endforeach -->
      </tbody>
    </table>

    <div style="background-color: #F2F2F2; border-radius: 15px; justify-content: center; align-items: center
            ; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); width: 150px; height: 40%;">

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
      </div>
      <!-- <div style="align-self: center; margin-right: auto">
        <div style="display: flex; margin: 10px">
          <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Editar</p>
        </div> -->
        <div style="display: flex; margin: 10px">
          <a><img src="{{asset("images/delete.png")}}" alt="Deletar orientador" style="width: 20px; height: 20px;"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
        </div>
      </div>
    </div>
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


@endsection