@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Plano de Atividades</h1>
        </div>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.plano-de-atividades.store', ['id' => $estagio->id]) }}"method="post">
            @csrf

            <h1 class="titulogrande">Estagiário</h1><br>

            <label for="Nome" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="Nome"
                id="Nome" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="Email" class="titulopequeno">Email<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="Email"
                id="Email" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso"
                id="curso" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="periodo" class="titulopequeno">Período<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo"
                id="periodo" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <h1 class="titulogrande">Campo de Estágio</h1><br>

            <label for="instituicao" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicao"
                id="instituicao" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="endereco" class="titulopequeno">Endereço (Local de realização do Estágio)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco"
                id="endereco" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="numCasa" class="titulopequeno">Número do Endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="numCasa"
                id="numCasa" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="complemento" class="titulopequeno">Complemento do Endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="complemento"
                id="complemento" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="fone" class="titulopequeno">Telefone<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="fone"
                id="fone" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="cep" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep"
                id="cep" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="bairro" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro"
                id="bairro" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cidade" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade"
                id="cidade" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="estado" class="titulopequeno">Estado<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estado"
                id="estado" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="pontoReferencia" class="titulopequeno">Ponto de Referencia<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="pontoReferencia"
                id="pontoReferencia" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="supervisorEstagio" class="titulopequeno">Supervisor do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisorEstagio"
                id="supervisorEstagio" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="FoneSupervisor" class="titulopequeno">Telefone do Supervisor do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="FoneSupervisor"
                id="FoneSupervisor" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="emailSup" class="titulopequeno">Email do Supervisor do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="emailSup"
                id="emailSup" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cargo" class="titulopequeno">Cargo do Supervisor do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargo"
                id="cargo" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="educacaoEscolar" class="titulopequeno">Educacao Escolar (Sim ou não)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="educacaoEscolar"
                id="educacaoEscolar" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="educacaoNaoEscolar" class="titulopequeno">Educacao Não-Escolar (Sim ou não)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="educacaoNaoEscolar"
                id="educacaoNaoEscolar" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="modalidade" class="titulopequeno">Modalidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="modalidade"
                id="modalidade" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            
            <h1 class="titulogrande">Programa de Estágio</h1><br>

            <label for="semestreLetivo" class="titulopequeno">Semestre Letivo<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="semestreLetivo"
                id="semestreLetivo" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="componenteCurricular" class="titulopequeno">Componente Curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="componenteCurricular"
                id="componenteCurricular" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="professorComponenteCurricular" class="titulopequeno">Professor do Componente Curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="professorComponenteCurricular"
                id="professorComponenteCurricular" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="professorOrientador" class="titulopequeno">Professor Orientador<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="professorOrientador"
                id="professorOrientador" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cargaHorariaSemanal" class="titulopequeno">Carga Horária Semanal<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargaHorariaSemanal"
                id="cargaHorariaSemanal" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="diasRealizacao" class="titulopequeno">Dias de Realização<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="diasRealizacao"
                id="diasRealizacao" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="horario" class="titulopequeno">Horário<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="horario"
                id="horario" required><br>
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
