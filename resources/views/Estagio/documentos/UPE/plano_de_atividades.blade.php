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
            <input class="boxcadastrar" type="text" name="nome" id="nome" placeholder="Digite o nome do estagiário" value="{{ $dados['nome'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="Email" class="titulopequeno">Email<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="email" id="email" placeholder="Digite o email do estagiário" value="{{ $dados['email'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" placeholder="Digite o curso do estagiário" value="{{ $dados['curso'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="periodo" class="titulopequeno">Período<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo" placeholder="Digite o período que o estagiário está cursando" value="{{ $dados['periodo'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            
            <h1 class="titulogrande">Campo de estágio</h1><br>

            <label for="instituicao" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicao" id="instituicao" placeholder="Digite o nome da instituição" value="{{ $dados['instituicao'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="endereco" class="titulopequeno">Endereço (Local de realização do estágio)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco" id="endereco" placeholder="Digite o endereço (Local de realização do Estágio)" value="{{ $dados['endereco'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="numCasa" class="titulopequeno">Número do endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="numCasa" id="numCasa" placeholder="Digite o número do endereço" value="{{ $dados['numCasa'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="complemento" class="titulopequeno">Complemento do endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="complemento" id="complemento" placeholder="Digite o complemento do endereço" value="{{ $dados['complemento'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="fone" class="titulopequeno">Telefone<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="fone" id="fone" placeholder="Digite o telefone" value="{{ $dados['fone'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cep" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep" id="cep" placeholder="Digite o cep do endereço" value="{{ $dados['cep'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="bairro" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro" id="bairro" placeholder="Digite o bairro do endereço" value="{{ $dados['bairro'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cidade" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade" id="cidade" placeholder="Digite a cidade do endereço" value="{{ $dados['cidade'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="estado" class="titulopequeno">Estado<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estado" id="estado" placeholder="Digite o estado do endereço" value="{{ $dados['estado'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="pontoReferencia" class="titulopequeno">Ponto de referência<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="pontoReferencia" id="pontoReferencia" placeholder="Digite o ponto de referencia do endereço" value="{{ $dados['pontoReferencia'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="supervisorEstagio" class="titulopequeno">Supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisorEstagio" id="supervisorEstagio" placeholder="Digite o nome do supervisor do estágio" value="{{ $dados['supervisorEstagio'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="FoneSupervisor" class="titulopequeno">Telefone do supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="FoneSupervisor" id="FoneSupervisor" placeholder="Digite o telefone do supervisor do estágio" value="{{ $dados['FoneSupervisor'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="emailSup" class="titulopequeno">Email do supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="emailSup" id="emailSup" placeholder="Digite o email do supervisor do estágio" value="{{ $dados['emailSup'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="cargo" class="titulopequeno">Cargo do supervisor do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargo" id="cargo" placeholder="Digite o cargo do supervisor do estágio" value="{{ $dados['cargo'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label class="titulopequeno">
                <input type="checkbox" name="educacaoEscolar" id="educacaoEscolar" value="Sim" {{ isset($dados['educacaoEscolar']) && $dados['educacaoEscolar'] == 'Sim' ? 'checked' : '' }}>
                Educação escolar<strong style="color: #8B5558"></strong>
            </label>
            <div class="invalid-feedback">Por favor, marque esta opção</div><br>
            <br>

            <label class="titulopequeno">
                <input type="checkbox" name="educacaoNaoEscolar" id="educacaoNaoEscolar" value="Sim" {{ isset($dados['educacaoNaoEscolar']) && $dados['educacaoNaoEscolar'] == 'Sim' ? 'checked' : '' }}>
                Educação não-escolar<strong style="color: #8B5558"></strong>
            </label>
            <div class="invalid-feedback">Por favor, marque esta opção</div><br>
            <br>

            <label for="anoInfantil" class="titulopequeno">Ano - Educação Infantil<strong style="color: #8B5558"></strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="anoInfantil" id="anoInfantil" placeholder="Digite o ano da Etapa da Educação Infantil" value="{{ $dados['anoInfantil'] ?? '' }}">
            <div class="invalid-feedback">Por favor preencha esse campo</div><br>

            <label for="anoFundamental" class="titulopequeno">Ano - Ensino Fundamental<strong style="color: #8B5558"></strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="anoFundamental" id="anoFundamental" placeholder="Digite o ano da Etapa do Ensino Fundamental" value="{{ $dados['anoFundamental'] ?? '' }}">
            <div class="invalid-feedback">Por favor preencha esse campo</div><br>

            <label for="anoMedio" class="titulopequeno">Ano - Ensino Médio<strong style="color: #8B5558"></strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="anoMedio" id="anoMedio" placeholder="Digite o ano da Etapa do Ensino Médio" value="{{ $dados['anoMedio'] ?? '' }}">
            <div class="invalid-feedback">Por favor preencha esse campo</div><br>

            <label for="modalidade" class="titulopequeno">Modalidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="modalidade" id="modalidade" placeholder="Digite a modalidade" value="{{ $dados['modalidade'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <h1 class="titulogrande">Programa de estágio</h1><br>

            <label for="semestreLetivo" class="titulopequeno">Semestre letivo<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="semestreLetivo" id="semestreLetivo" placeholder="Digite a semestre letivo" value="{{ $dados['semestreLetivo'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="componenteCurricular" class="titulopequeno">Componente curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="componenteCurricular" id="componenteCurricular" placeholder="Digite o componente curricular" value="{{ $dados['componenteCurricular'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="professorComponenteCurricular" class="titulopequeno">Professor do componente curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="professorComponenteCurricular" id="professorComponenteCurricular" placeholder="Digite o nome do professor do componente curricular" value="{{ $dados['professorComponenteCurricular'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="professorOrientador" class="titulopequeno">Professor orientador<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="professorOrientador" id="professorOrientador" placeholder="Digite o nome do professor orientador" value="{{ $dados['professorOrientador'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="periodoVigencia" class="titulopequeno">Período de Vigência do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodoVigencia" id="periodoVigencia" placeholder="Digite o período de vigência do estágio" value="{{ $dados['periodoVigencia'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="cargaHorariaSemanal" class="titulopequeno">Carga horária semanal<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargaHorariaSemanal" id="cargaHorariaSemanal" placeholder="Digite a carga horária semanal" value="{{ $dados['cargaHorariaSemanal'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="diasRealizacao" class="titulopequeno">Dias de realização<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="diasRealizacao" id="diasRealizacao" placeholder="Digite os dias de realização do estágio" value="{{ $dados['diasRealizacao'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="horario" class="titulopequeno">Horário<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="horario" id="horario" placeholder="Digite o horário de realização do estágio" value="{{ $dados['horario'] ?? '' }}" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            
            <label for="objetivosEstagio" class="titulopequeno">Objetivos do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <textarea class="boxcadastrar" name="objetivosEstagio" id="objetivosEstagio" placeholder="Digite os Objetivos do estágio" required rows="5" style="height: 150px;">{{ $dados['objetivosEstagio'] ?? '' }}</textarea>
            <div class="invalid-feedback">Por favor preencha esse campo</div><br>
            
                       
            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            


        </form>

    </div>
    </div>
@endsection
