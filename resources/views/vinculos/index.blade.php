@extends("templates.app")

@section("body")


  <div class="container">
    <div>
      <h1><strong>Vínculos</strong></h1>
      @auth
        @if (auth()->user()->typage_type == "App\Models\Servidor")
          <a type="button" data-bs-toggle="modal" data-bs-target="#criarModal">
            <img src="{{asset("images/add-icon.png")}}" class="add-button" alt="Adicionar professor">
          </a>
          @include("vinculos.componentes.modal_criar")
        @endif
      @endauth
    </div>

    <div style="text-align: right; margin-top: 20px">
      <form action="{{ route("vinculos.index" )}}" method="get">
        <input class="input-modal-create input-search" type="text" name="search" placeholder="Pesquisar por" old="{{$search}}">
        <button class="btn btn-primary submit">Pesquisar</button>
      </form>
    </div>
    
    @if (sizeof($vinculos) == 0)
      <div class="empty">
        <p>
          Não há vinculos em andamento!
        </p>
      </div>
    @else
        <br>
        @foreach ($vinculos as $vinculo) 
          <div class="row justify-content-md-center listing-card">
            <div class="col-md-1 col-lg-1 status">
              <img src="{{asset("images/$vinculo->status.png")}}" class="status-icon">
            </div>
            <div class="col-md-9 col-lg-9 informacoes">
              <a type="button" style="text-decoration: none; color: black;" onclick="exibirModalVer({{$vinculo}}, {{$vinculo->professor}}, {{$vinculo->aluno}}, {{$vinculo->aluno->user}}, {{$auth}})">
                <label class="labelIndex">{{$vinculo->professor->nome}} - {{$vinculo->aluno->user->name}}</label>
                <hr class="labelIndex">
                <label class="labelIndex">{{$vinculo->programa}} - {{$vinculo->bolsa}} - {{$vinculo->semestre}}</label>
              </a>
            </div>
            @auth
              @if (auth()->user()->typage_type == "App\Models\Servidor")          
                <div id="opcoes" class="col-md-2 col-lg-2 opcoes row">
                  <a type="button" class="col-md-auto edit" onclick="exibirModalEditar({{$vinculo}})">
                    <img src="{{asset("images/editar.png")}}" class="option-button" alt="Editar Vinculo">
                  </a>
                  <a type="button" class="col-md-auto delete" onclick="exibirModalDelete({{$vinculo}})">
                    <img src="{{asset("images/excluir.png")}}" class="option-button" alt="Excluir Vinculo">
                  </a>
                </div>
              @else
                <div class="col-md-2 col-lg-2 opcoes">
                  <a type="button" class="edit" onclick="exibirModalRelatorio({{$vinculo->id}})">
                    <img src="{{asset("images/relatorio.png")}}" class="relatorio-icon" alt="Relatorio final">
                  </a>
                </div>
                @include("vinculos.componentes.modal_relatorio")
              @endif
            @endauth
          </div>
          <br>
        @endforeach

        @include("vinculos.componentes.modal_ver")

        @auth
          @if (auth()->user()->typage_type == "App\Models\Servidor")
            @include("vinculos.componentes.modal_delete")
            @include("vinculos.componentes.modal_edit")
          @endif
        @endauth
    @endif
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