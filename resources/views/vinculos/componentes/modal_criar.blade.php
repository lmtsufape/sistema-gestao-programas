<div class="modal fade" id="criarModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content modal-create">
      <div class="modal-header" >
        <h5 class="modal-title title" >Cadastro de vínculo</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route("vinculos.store")}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="select-alunos" class="form-label">Selecione um aluno</label>
                <select id="select-alunos" name="alunos" class="form-control input-modal-vinculo" >
                  <option value=""></option>
                  @foreach ($alunos as $aluno)
                    <option value="{{$aluno->id}}">{{$aluno->user->name}} - {{$aluno->cpf}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="select-programas" class="form-label">Selecione um programa</label>
                <select name="programa" id="select-programas" class="form-control input-modal-vinculo">
                  <option value=""></option>
                  <option value="BIA">BIA</option>
                  <option value="PAVI">PAVI</option>
                  <option value="PET">PET</option>
                  <option value="TUTORIA">TUTORIA</option>
                  <option value="MONITORIA">MONITORIA</option>
                </select>
              </div>

              <div class="form-group">
                <label for="select-bolsa" class="form-label">Selecione uma bolsa</label>
                <select name="bolsa" id="select-bolsa" class="form-control input-modal-vinculo">
                  <option value=""></option>
                  <option value="VOLUNTARIA">Voluntária</option>
                  <option value="REMUNERADA">Remunerada</option>
                </select>
              </div>

              <div class="form-group">
                <label for="curso" class="form-label">informe o curso</label>
                <input type="text" name="curso" id="curso" class="form-control input-modal-vinculo" placeholder="Informe o curso" disabled/>
              </div>

              <div class="form-group">
                <label for="data-inicio" class="form-label">Informe a data inicial</label>
                <input type="date" name="data-inicio" id="data-inicio" class="form-control input-modal-vinculo"/>
              </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="select-professores" class="form-label">Selecione um professor</label>
                <select name="professores" id="select-professores" class="form-control input-modal-vinculo">
                  <option value=""></option>
                  @foreach ($professors as $professor)
                    <option value="{{$professor->id}}">{{$professor->nome}} - {{$professor->cpf}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="semestre" class="form-label">Informe o semestre</label>
                <input type="text" name="semestre" id="semestre" class="form-control input-modal-vinculo" placeholder="Informe o semestre"/>
              </div>

              <div class="form-group">
                <label for="valor-bolsa" class="form-label">Informe o valor da bolsa</label>
                <input type="number" step="0.01" name="valor-bolsa" id="valor-bolsa" class="form-control input-modal-vinculo" placeholder="Informe o valor da bolsa" disabled/>
              </div>

              <div class="form-group">
                <label for="disciplina" class="form-label">informe a disciplina</label>
                <input type="text" name="disciplina" id="disciplina" class="form-control input-modal-vinculo" placeholder="Informe a disciplina" disabled/>
              </div>

              <div class="form-group">
                <label for="data-fim" class="form-label">Selecione a data final</label>
                <input type="date" name="data-fim" id="data-fim" class="form-control input-modal-vinculo"/>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px;">Cadastrar vínculo</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  let alunos = <?= $alunos ?>;

  //Criando select de alunos
  $("#select-alunos").chosen({
    placeholder_text_single: "Selecione um aluno",
    allow_single_deselect: true,
    max_selected_options: 1,
    max_shown_results : 5,
    width: "95%",
    no_results_text: "Não possui alunos."
  });

  //Criando select de programas
  $("#select-programas").chosen({
    placeholder_text_single: "Selecione um programa",
    allow_single_deselect: true,
    max_selected_options: 1,
    max_shown_results : 5,
    width: "95%"
  });

  //Criando select de programas
  $("#select-professores").chosen({
    placeholder_text_single: "Selecione um professor",
    allow_single_deselect: true,
    max_selected_options: 1,
    max_shown_results : 5,
    width: "95%"
  });

  //Criando select de bolsa
  $("#select-bolsa").chosen({
    placeholder_text_single: "Selecione a bolsa",
    allow_single_deselect: true,
    max_selected_options: 1,
    max_shown_results : 5,
    width: "95%"
  });

  //caso a bolsa programa selecionado seja tutoria ou monitoria, habilita o campo disciplina e curso
  $("#select-programas").change(function(){
    if ($(this).val() == "TUTORIA" || $(this).val() == "MONITORIA"){
      $("#curso").attr("disabled", false);
      $("#disciplina").attr("disabled", false);
    } else {
      $("#curso").val("").attr("disabled", true);
      $("#disciplina").val("").attr("disabled", true);
    }
  });

  //verificar se o aluno selecionado já tem bolsa remunerada
  $("#select-alunos").change(function(){
    if ($("#select-bolsa").val() == "REMUNERADA"){
      alunos.forEach(aluno => {
        if ($("#select-alunos").val() == aluno.id && aluno.proibido == true){
          alert("Aluno selecionado já tem vínculo remunerado.");
          $(this).val('').trigger('chosen:updated');
        }
      });
    } 
  });

  //verificar se o aluno selecionado já tem bolsa remunerada
  $("#select-bolsa").change(function(){
    if ($("#select-alunos").val() == ""){
      alert("Deve ser selecionado um aluno primeiro.");
      $(this).val('').trigger('chosen:updated');
      $('#valor-bolsa').val("").attr('disabled', true);
    } else { 
      if ($(this).val() == "REMUNERADA"){
        $("#valor-bolsa").attr("disabled", false);
        alunos.forEach(aluno => {
          if ($("#select-alunos").val() == aluno.id && aluno.proibido == true){
            $(this).val('').trigger('chosen:updated');
            $("#valor-bolsa").val("").attr("disabled", true);
            alert("Aluno selecionado já tem vínculo remunerado.");
          }
        });
      } else {
        $("#valor-bolsa").val("").attr("disabled", true);
      }
    }
  })

</script>

