@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Plano de atividades</h1>
        </div>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UPE.plano-de-atividades.store', ['id' => $estagio->id]) }}"method="post">
            @csrf

            <h1 class="titulogrande">Estagiário</h1><br>

            <label for="Nome" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome"
                id="nome" 
                placeholder="Digite o nome do estagiário"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="Email" class="titulopequeno">Email<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="email"
                id="email" 
                placeholder="Digite o email do estagiário"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso"
                id="curso" 
                placeholder="Digite o curso do estagiário"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="periodo" class="titulopequeno">Período<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo"
                id="periodo" 
                placeholder="Digite o período que o estagiário está cursando"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <h1 class="titulogrande">Campo de estágio</h1><br>

            <label for="instituicao" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicao"
                id="instituicao" 
                placeholder="Digite o nome da instituição"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="endereco" class="titulopequeno">Endereço (Local de realização do estágio)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco"
                id="endereco" 
                placeholder="Digite o endereço (Local de realização do Estágio)"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="numCasa" class="titulopequeno">Número do endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="numCasa"
                id="numCasa" 
                placeholder="Digite o número do endereço"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="complemento" class="titulopequeno">Complemento do endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="complemento"
                id="complemento" 
                placeholder="Digite o complemento do endereço"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="fone" class="titulopequeno">Telefone<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="fone"
                id="fone" 
                placeholder="Digite o telefone"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="cep" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep"
                id="cep" 
                placeholder="Digite o cep do endereço"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="bairro" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro"
                id="bairro" 
                placeholder="Digite o bairro do endereço"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cidade" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade"
                id="cidade" 
                placeholder="Digite a cidade do endereço"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="estado" class="titulopequeno">Estado<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estado"
                id="estado" 
                placeholder="Digite o estado do endereço"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="pontoReferencia" class="titulopequeno">Ponto de referência<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="pontoReferencia"
                id="pontoReferencia" 
                placeholder="Digite o ponto de referencia do endereço"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="supervisorEstagio" class="titulopequeno">Supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisorEstagio"
                id="supervisorEstagio" 
                placeholder="Digite o nome do supervisor do estágio"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="FoneSupervisor" class="titulopequeno">Telefone do supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="FoneSupervisor"
                id="FoneSupervisor" 
                placeholder="Digite o telefone do supervisor do estágio"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="emailSup" class="titulopequeno">Email do supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="emailSup"
                id="emailSup" 
                placeholder="Digite o email do supervisor do estágio"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cargo" class="titulopequeno">Cargo do supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargo"
                id="cargo" 
                placeholder="Digite o cargo do eupervisor do estágio"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="educacaoEscolar" class="titulopequeno">Educacao escolar (Sim ou não)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="educacaoEscolar"
                id="educacaoEscolar" 
                placeholder="Educacao escolar (Sim ou não)"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="educacaoNaoEscolar" class="titulopequeno">Educacao não-escolar (Sim ou não)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="educacaoNaoEscolar"
                id="educacaoNaoEscolar" 
                placeholder="Educacao não-escolar (Sim ou não)"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="modalidade" class="titulopequeno">Modalidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="modalidade"
                id="modalidade" 
                placeholder="Digite a modalidade"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            
            <h1 class="titulogrande">Programa de estágio</h1><br>

            <label for="semestreLetivo" class="titulopequeno">Semestre letivo<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="semestreLetivo"
                id="semestreLetivo" 
                placeholder="Digite a semestre letivo"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="componenteCurricular" class="titulopequeno">Componente curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="componenteCurricular"
                id="componenteCurricular" 
                placeholder="Digite o componente curricular"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="professorComponenteCurricular" class="titulopequeno">Professor do componente curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="professorComponenteCurricular"
                id="professorComponenteCurricular" 
                placeholder="Digite o nome do professor do componente curricular"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="professorOrientador" class="titulopequeno">Professor orientador<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="professorOrientador"
                id="professorOrientador" 
                placeholder="Digite o nome do professor orientador"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cargaHorariaSemanal" class="titulopequeno">Carga horária semanal<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargaHorariaSemanal"
                id="cargaHorariaSemanal" 
                placeholder="Digite a carga horária semanal"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="diasRealizacao" class="titulopequeno">Dias de realização<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="diasRealizacao"
                id="diasRealizacao" 
                placeholder="Digite os dias de realização do estágio"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="horario" class="titulopequeno">Horário<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="horario"
                id="horario" 
                placeholder="Digite o horário de realização do estágio"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            


        </form>

    </div>
    </div>
@endsection
