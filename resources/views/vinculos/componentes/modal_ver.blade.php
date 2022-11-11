<div class="modal fade show" id="verModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content modal-create">
      <div class="modal-header" >
        <div class="btn-group">
          <button type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background-color: inherit; padding: 0px;">
            <img src="{{asset("images/menu_tres_pontos.svg")}}" class="option-button" alt="Menu">
          </button>
          <ul class="dropdown-menu">
            <li>
              <form id="cert_form" class="dropdown-item" method="get">
                @csrf
                <input id="programa_cert" name="programa" type="hidden">
                <button type="submit" formtarget="_blank" style="border: none; background-color: inherit">
                  Certificado
                </button>
              </form>
            </li>
            <li><a class="dropdown-item" target="_blank" id="frequencia_mensal">Frequência mensal</a></li>
            @if (auth()->user()->typage_type == "App\Models\Servidor")
              <li>
                <form id="declaracao" class="dropdown-item" method="get">
                  @csrf
                  <input id="programa_dec" name="programa" type="hidden">
                  <button type="submit" formtarget="_blank" style="border: none; background-color: inherit">
                    Declaração
                  </button>
                </form>
              </li>
            @endif
            @if (auth()->user()->typage_type == "App\Models\Servidor")
              <li><a class="dropdown-item" target="_blank" id="relatorio_final">Relatório final</a></li>
            @endif
          </ul>
        </div>
        <h5 id="programa_ver" class="modal-title title"></h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label">Aluno</label>
              <div class="modal-ver" id="nome_aluno_ver" ></div>
            </div> 

            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="status_ver" class="form-label">Status</label>
              <div class="modal-ver" id="status_ver" ></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label">Professor</label>
              <div class="modal-ver" id="nome_professor_ver" ></div>
            </div> 

            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="bolsa_ver" class="form-label">Bolsa</label>
              <div class="modal-ver" id="bolsa_ver" style="color: green"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label">Começo do Programa</label>
              <div class="modal-ver" id="data_inicio_ver" ></div>
            </div> 

            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="end_ver" class="form-label">Previsão de fim do programa</label>
              <div class="modal-ver" id="data_fim_ver" ></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="semestre_ver"class="form-label">Semestre</label>
              <div class="modal-ver" id="semestre_ver" ></div>
            </div> 

            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="curso_ver" class="form-label">Curso</label>
              <div class="modal-ver" id="curso_ver" ></div>
            </div>
          </div>
          <div class="contaainer">
            <label for="disciplina_ver" class="form-label">Disciplina</label>
            <div class="modal-ver" id="disciplina_ver" ></div>
          </div>
        
          <div style="margin-bottom: 15px; margin-top: 15px">
            <p></p>
            <a class="btn btn-primary submit-button" data-bs-dismiss="modal" style="width: 230px" role="button">Voltar</a>
          </div> 

        </div>
    </div>
  </div>
</div>
<script>
  let status_ver = $('#status_ver');
  let bolsa_ver = $('#bolsa_ver');
  let nome_aluno_ver = $('#nome_aluno_ver');
  let nome_professor_ver = $('#nome_professor_ver');
  let data_inicio_ver = $('#data_inicio_ver');
  let data_fim_ver = $('#data_fim_ver');
  let programa_ver = $('#programa_ver')
  let semestre_ver = $('#semestre_ver')
  let curso_ver = $('#curso_ver')
  let disciplina_ver = $('#disciplina_ver')
  let programa_cert = $("#programa_cert")
  let programa_dec = $("#programa_dec")

  function exibirModalVer(vinculo, professor, aluno, user, auth){
    status_ver.text(vinculo.status)
    
    if (vinculo.status == "ANDAMENTO"){
      document.getElementById("status_ver").style.color = "yellow";
    }else if(vinculo.status == "CONCLUIDA"){
      document.getElementById("status_ver").style.color = "green";
    } else {
      document.getElementById("status_ver").style.color = "red";
    }

    if (vinculo.bolsa == "REMUNERADA"){
      bolsa_ver.text("R$ " + vinculo.valor_bolsa)
    }else{
      bolsa_ver.text(vinculo.bolsa)
    }
    programa_ver.text(vinculo.programa)
    nome_aluno_ver.text(user.name)
    nome_professor_ver.text(professor.nome)
    
    let data = new Date(vinculo.data_inicio);
    data_inicio_ver.text(data.getDate() + "/" + data.getMonth() + "/" + data.getFullYear())
    
    data = new Date(vinculo.data_fim);
    data_fim_ver.text(data.getDate() + "/" + data.getMonth() + "/" + data.getFullYear())

    semestre_ver.text(vinculo.semestre)
    curso_ver.text(vinculo.curso)
    if(vinculo.disciplina){
      disciplina_ver.text(vinculo.disciplina)
    }else{
      disciplina_ver.text("Não foi necessário disciplina.")
    }
    $("#frequencia_mensal").attr('href', `/vinculos/frequencia/${vinculo.id}`)

    programa_cert.val(vinculo.programa);
    document.getElementById('cert_form').action = `/vinculos/certificado/${vinculo.id}`;

    // Habilitando botao de ver relatorio apenas quando existir relatorio
    if(auth.typage_type == "App\\Models\\Servidor"){
      programa_dec.val(vinculo.programa);
      document.getElementById('declaracao').action = `/vinculos/declaracao/${vinculo.id}`;
      if(vinculo.relatorio){
        // Exibe
        $("#relatorio_final").attr('href', `storage/${aluno.cpf}/${vinculo.id}.pdf`)
        document.getElementById("relatorio_final").style.display = "block";
      } else{
        // Oculta
        document.getElementById("relatorio_final").style.display = "none";
      }
    }

    $('#verModal').modal('show');
  }

</script>