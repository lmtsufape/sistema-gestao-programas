@extends("templates.app")

@section("body")

  <style>
    .botaoverde {
      border: none;
      color: white;
      font-style: normal;
      font-weight: 700;
      font-size: 20px;
      line-height: 23px;
      text-align: center;
      width: 260px;
      height: 123px;
      left: 193px;
      top: 249px;
      display: flex;
      align-items: center;
      padding-left: 20px;

      background: #34A853;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      border-radius: 20px;
    }

    .botaoazul {
      border: none;
      color: white;
      font-style: normal;
      font-weight: 700;
      font-size: 20px;
      line-height: 23px;
      text-align: center;
      width: 260px;
      height: 123px;
      left: 193px;
      top: 249px;
      display: flex;
      align-items: center;
      padding-left: 20px;
      

      background: #2D3875;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.25);
      border-radius: 20px;
    }
  </style>


  <div class="container">
    <div>

      <h1 
      style="font-style: normal; padding-top: 38px;
      font-weight: 700; text-align:start ;
      font-size: 35px; line-height: 41px; color: #131833;">
      Bem vindo(a)!
      </h1>
      <hr>

      @auth
        @if (auth()->user()->typage_type == "App\Models\Servidor")
          <a type="button" data-bs-toggle="modal" data-bs-target="#criarModal">
            <img src="{{asset("images/add-icon.png")}}" class="add-button" alt="Adicionar professor">
          </a>
          @include("vinculos.componentes.modal_criar")
        @endif
      @endauth

    </div>

    <div style="display: flex; gap: 25px; align-items: center; margin: auto;">

      <button class="botaoverde">
          <img src="{{asset("images/DocumentAdd.png")}}" alt="logodoc" style="padding-right: 10px;">
          Listagem de documentos
      </button>
      <button class="botaoazul">
          <img src="{{asset("images/DocumentAdd.png")}}" alt="logodoc" style="padding-right: 10px;">
          Gerar documentos
      </button>
      <button class="botaoverde">
          <img src="{{asset("images/DocumentAdd.png")}}" alt="logodoc" style="padding-right: 10px;">
          Meus certificados
      </button>
      <button class="botaoazul">
          <img src="{{asset("images/DocumentAdd.png")}}" alt="logodoc" style="padding-right: 10px;">
          Meus programas
      </button>
      
    </div>    
    
  </div>

  <script>
    function exibirModalEditar(vinculo){
      $('#id_edit').val(vinculo.id);
      $("#select-alunos-edit").find("option[value=" + vinculo.aluno_id + "]").attr("selected", true).trigger("chosen:updated");
      $("#select-professores-edit").find("option[value=" + vinculo.professor_id + "]").attr("selected", true).trigger("chosen:updated");
      $("#select-bolsa-edit").find("option[value=" + vinculo.bolsa + "]").attr("selected", true).trigger("chosen:updated");
      $("#select-programas-edit").find("option[value=" + vinculo.programa + "]").attr("selected", true).trigger("chosen:updated");
      $("#semestre-edit").val(vinculo.semestre);
      vinculo.valor_bolsa ? $("#valor-bolsa-edit").val(vinculo.valor_bolsa).attr("disabled", false) : $("#valor-bolsa-edit").val('').attr("disabled", true);
      vinculo.curso ? $("#curso-edit").val(vinculo.curso).attr("disabled", false) : $("#curso-edit").val('').attr("disabled", true);
      vinculo.disciplina ? $("#disciplina-edit").val(vinculo.disciplina).attr("disabled", false) : $("#disciplina-edit").val('').attr("disabled", true);
      vinculo.data_inicio ? $("#data-inicio-edit").val(vinculo.data_inicio).attr("disabled", false) : $("#data-inicio-edit").val('').attr("disabled", true);
      vinculo.data_fim ? $("#data-fim-edit").val(vinculo.data_fim).attr("disabled", false) : $("#data-fim-edit").val('').attr("disabled", true);

      $("#editarModal").modal("show");
    }

    function exibirModalRelatorio(id){
      $("#modal_relatorio_" + id).modal("show");
    }
  </script>

@endsection