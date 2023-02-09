@extends("templates.app")

@section("body")

  @can('servidor')
  <div class="container" style="font-family: 'Roboto', sans-serif;">
    @if (session('sucesso'))
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
    @endif
    <br>
    <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
      <h1><strong>Disciplinas</strong></h1>
      {{--  TODO: Falta adicionar um modal com os possiveis filtros  --}}
      <form action="{{route("disciplinas.index")}}" method="GET">
        <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              background-position: 10px 2px;
              background-repeat: no-repeat;
              width: 35%;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              margin-bottom: 12px;
              margin-right: 12px;"/>
        <input type="submit" value="" style="background-image: url('/images/searchicon.png');
              background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              width: 50px;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              position: absolute;
              margin: auto;"/>
      </form>
    </div>
    <div style="display: contents; align-content: center; align-items: center;">

        <a style="background: #2D3875; border-radius: 25px; border: #2D3875; color: #f0f0f0; font-style: normal;
        font-weight: 400; font-size: 24px; line-height: 28px; padding-top: 6px; padding-bottom: 6px; align-content: center;
        align-items: center; padding-right: 15px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none;
        padding-left: 10px;"
        href="{{route("disciplinas.create")}}">
        <img src="{{asset("images/plus.png")}}" alt="Cadastrar Disciplina" style="padding-bottom: 5px"> Cadastrar Disciplina
        </a>
        <br>
    </div>

    @if (sizeof($disciplinas) == 0)
      <div class="empty">
        <p>
          Não há disciplinas cadastradas
        </p>
      </div>
    @else
      <br>
      
      <div style="display: flex; gap: 30px">
        <table class="table" style="border-radius: 15px; background-color: #F2F2F2; min-width: 600px; box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25)
        ;margin-bottom: 5px; min-height: 350px">
          <thead>
            <tr>
              <th scope="col" style="border-right: 1px solid #d3d3d3;">Nome</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          @foreach ($disciplinas as $disciplinas)
            <tbody>
              <tr> 
                <td style="border-right: 1px solid #d3d3d3; border-bottom: 1px solid #d3d3d3;">{{$disciplinas->nome}}</td>
                <td style="border-bottom: 1px solid #d3d3d3;">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$disciplinas->id}}" >
                    <img src="{{asset("images/info.png")}}" alt="Info programa" style="height: 30px; width: 30px;">
                  </a>
                  <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$disciplinas->id}}">
                    <img src="{{asset("images/document.png")}}" alt="Documento programa" style="height: 30px; width: 30px;">
                    {{--  TODO: Fica pra fazer o modal depois  --}}
                  </a>
                  <a href="{{url("/disciplinas/$disciplinas->id/edit")}}">
                    <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar programa" style="height: 30px; width: 30px;">
                  </a>
                  <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$disciplinas->id}}">
                    <img src="{{asset("images/delete.png")}}" alt="Deletar programa" style="height: 30px; width: 30px;">
                  </a>                                     
                </td>
              </tr>
              @include("Disciplina.components.modal_show", ["disciplina" => $disciplinas])
              @include("Disciplina.components.modal_delete", ["disciplina" => $disciplinas])
            </tbody>          
          @endforeach            
        </table>
        <div style="background-color: #F2F2F2; border-radius: 15px; justify-content: center; align-items: center
          ; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); width: 150px; height: 40%;">
          <div style="align-self: center; margin-right: auto">
            <br>
            <h4 style="font-size: 15px">Legenda dos ícones:</h4>
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
      {{--  <div style="margin: auto; width: 45%; padding: 10px;">
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