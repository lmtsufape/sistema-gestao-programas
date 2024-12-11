@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Termo de compromisso</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UPE.termo-de-compromisso.store', ['id' => $estagio->id]) }}"
            method="post">
            @csrf

            <!-- INSTITUIÇÃO DE ENSINO -->
            <h1 class="titulogrande">Instituição de ensino</h1>

            <label for="ProfessorComponenteCurricular" class="titulopequeno">Docente componente curricular<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="ProfessorComponenteCurricular"
                id="ProfessorComponenteCurricular" placeholder=" Digite o nome do docente do componente curricular"
                value="{{ $dados['professorComponenteCurricular'] ?? '' }}" required><br><br>

            <label for="instituicaoEmail" class="titulopequeno">E-mail do docente do componente curricular<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="email" name="instituicaoEmail" id="instituicaoEmail"
                placeholder=" Digite o email do docente do componente corricular"
                value="{{ $dados['instituicaoEmail'] ?? '' }}" required><br><br>

            <label for="orientador" class="titulopequeno">Orientador<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="orientador" id="orientador"
                value="{{ $orientador->user->name }}" readonly style="background: #eee; "
                value="{{ $dados['instituicaoEmail'] ?? '' }}" required><br><br>

            <label for="emailOrientador" class="titulopequeno">E-mail do orientador<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="email" name="emailOrientador" id="emailOrientador"
                value="{{ $orientador->user->email }}" readonly style="background: #eee; " required><br><br>

            <!-- UNIDADE CONCEDENTE -->
            <h1 class="titulogrande">Unidade concedente</h1>

            <label for="cnpj" class="titulopequeno">CNPJ<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cnpj" id="cnpj"
                placeholder=" Digite o CNPJ da unidade concedente" value="{{ $dados['cnpj'] ?? '' }}" required><br><br>

            <label for="localEstagio" class="titulopequeno">Local de estágio<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="localEstagio" id="localEstagio"
                placeholder=" Digite o nome da instituição onde será feito o estágio"
                value="{{ $dados['localEstagio'] ?? '' }}" required><br><br>

            <label for="endereco" class="titulopequeno">Endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco" id="endereco"
                placeholder=" Digite o endereço da unidade concedente" value="{{ $dados['endereco'] ?? '' }}"
                required><br><br>

            <label for="numero" class="titulopequeno">Número<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="numero" id="numero"
                placeholder=" Digite o número do endereço da unidade concedente" value="{{ $dados['numero'] ?? '' }}"
                required><br><br>

            <label for="complemento" class="titulopequeno">Complemento<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="complemento" id="complemento"
                placeholder=" Digite o complemente do endereço da unidade concedente"
                value="{{ $dados['complemento'] ?? '' }}" required><br><br>

            <label for="cep" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep" id="cep"
                placeholder=" Digite o CEP do endereço da unidade concedente" value="{{ $dados['cep'] ?? '' }}"
                required><br><br>

            <label for="bairro" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro" id="bairro"
                placeholder=" Digite o bairro da unidade concedente" value="{{ $dados['bairro'] ?? '' }}"
                required><br><br>

            <label for="cidade" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade" id="cidade"
                placeholder=" Digite a cidade que unidade concedente está localizada"
                value="{{ $dados['cidade'] ?? '' }}" required><br><br>

            <label for="estado" class="titulopequeno">Estado<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estado" id="estado"
                placeholder=" Digite o estado que a unidade concedente está localizada"
                value="{{ $dados['estado'] ?? '' }}" required><br><br>

            <label for="representanteLegal" class="titulopequeno">Representante legal<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="representanteLegal" id="representanteLegal"
                placeholder=" Digite o nome do representante legal da unidade concedente"
                value="{{ $dados['representanteLegal'] ?? '' }}" required><br><br>

            <label for="cargoRepresentante" class="titulopequeno">Cargo do representante<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargoRepresentante" id="cargoRepresentante"
                placeholder=" Digite o cargo do representante legal" value="{{ $dados['cargoRepresentante'] ?? '' }}"
                required><br><br>

            <!-- SUPERVISOR -->
            <label for="cargoSupervisor" class="titulopequeno">Cargo do supervisor<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargoSupervisor" id="cargoSupervisor"
                placeholder=" Digite o cargo do supervisor do estágio" value="{{ $dados['cargoSupervisor'] ?? '' }}"
                required><br><br>

            <label for="formacaoSupervisor" class="titulopequeno">Formação do supervisor<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="formacaoSupervisor" id="formacaoSupervisor"
                placeholder=" Digite a formação do supervisor do estágio"
                value="{{ $dados['formacaoSupervisor'] ?? '' }}" required><br><br>

            <label for="cpfSupervisor" class="titulopequeno">CPF do supervisor<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cpfSupervisor" id="cpfSupervisor"
                placeholder=" Digite o CPF do supervisor do estágio" value="{{ $dados['cpfSupervisor'] ?? '' }}"
                required><br><br>

            <label for="emailSupervisor" class="titulopequeno">E-mail do supervisor<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="email" name="emailSupervisor" id="emailSupervisor"
                placeholder=" Digite o email do supervisor do estágio" value="{{ $dados['emailSupervisor'] ?? '' }}"
                required><br><br>

            <label for="telefoneSupervisor" class="titulopequeno">Telefone do supervisor<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="tel" name="telefoneSupervisor" id="telefoneSupervisor"
                placeholder=" Digite o número do telefone do supervisor do estágio"
                value="{{ $dados['telefoneSupervisor'] ?? '' }}" required><br><br>

            <!-- ESTAGIÁRIO -->
            <h1 class="titulogrande">Dados do estagiário</h1>

            <label for="nomeAluno" class="titulopequeno">Nome do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nomeAluno" id="nomeAluno"
                placeholder=" Digite o nome do aluno que vai ser estagiário" value="{{ $aluno->user->name }}" readonly
                style="background: #eee; " required><br><br>

            <label for="cpfAluno" class="titulopequeno">CPF do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cpfAluno" id="cpfAluno"
                placeholder=" Digite o CPF do aluno que vai ser estagiário" value="{{ $aluno->user->cpf }}" readonly
                style="background: #eee; " required><br><br>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso"
                placeholder=" Digite o curso do aluno que vai ser estagiário" value="{{ $aluno->curso->nome }}" readonly
                style="background: #eee; " required><br><br>

            <label for="periodo" class="titulopequeno">Período<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo"
                placeholder=" Digite o período que está o aluno que vai ser estagiário"
                value="{{ $dados['periodo'] ?? '' }}" required><br><br>

            <label for="enderecoAluno" class="titulopequeno">Endereço do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="enderecoAluno" id="enderecoAluno"
                placeholder=" Digite o endereço do aluno que vai ser estagiário"
                value="{{ $dados['enderecoAluno'] ?? '' }}" required><br><br>

            <label for="numeroEnderecoAluno" class="titulopequeno">Número do endereço do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="numeroEnderecoAluno" id="numeroEnderecoAluno"
                placeholder=" Digite o número do endereço do aluno que vai ser estagiário"
                value="{{ $dados['numeroEnderecoAluno'] ?? '' }}" required><br><br>

            <label for="complementoAluno" class="titulopequeno">Complemento do endereço do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="complementoAluno" id="complementoAluno"
                placeholder=" Digite o complemento do endereço do aluno que vai ser estagiário"
                value="{{ $dados['complementoAluno'] ?? '' }}"><br><br>
            <label for="cepAluno" class="titulopequeno">CEP do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cepAluno" id="cepAluno"
                placeholder=" Digite o CEP do endereço do aluno que vai ser estagiário"
                value="{{ $dados['cepAluno'] ?? '' }}" required><br><br>

            <label for="bairroAluno" class="titulopequeno">Bairro do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairroAluno" id="bairroAluno"
                placeholder=" Digite o bairro do endereço do aluno que vai ser estagiário"
                value="{{ $dados['bairroAluno'] ?? '' }}" required><br><br>

            <label for="cidadeAluno" class="titulopequeno">Cidade do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidadeAluno" id="cidadeAluno"
                placeholder=" Digite a cidade em que aluno que vai ser estagiário mora"
                value="{{ $dados['cidadeAluno'] ?? '' }}" required><br><br>

            <label for="estadoAluno" class="titulopequeno">Estado do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estadoAluno" id="estadoAluno"
                placeholder=" Digite o estado em que aluno que vai ser estagiário mora"
                value="{{ $dados['estadoAluno'] ?? '' }}" required><br><br>

            <label for="telefoneAluno" class="titulopequeno">Telefone do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="tel" name="telefoneAluno" id="telefoneAluno"
                placeholder=" Digite o número do telefone do aluno" value="{{ $dados['telefoneAluno'] ?? '' }}"
                required><br><br>

            <label for="emailAluno" class="titulopequeno">E-mail do aluno<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="email" name="emailAluno" id="emailAluno"
                value="{{ $aluno->user->email }}" readonly style="background: #eee; " required><br><br>

            <h2>CLÁUSULA 1ª</h2>
            <p>Constitui objeto do presente Termo de Compromisso a normatização da relação jurídica especial entre a
                UNIVERSIDADE DE PERNAMBUCO, a CONCEDENTE e o(a) ESTAGIÁRIO(A) para a realização de estágio curricular
                obrigatório, com fundamento nas disposições da Lei nº 11.788/2008 e na Resolução UPE/CEPE 070/2018.</p>

            <h2>CLÁUSULA 2ª</h2>
            <p>O estágio aqui compromissado terá vigência de
                <input type="text" name="data_inicio" style="width: 80px"
                    value="{{ $estagio->data_inicio->format('d/m/Y') }}">
                a
                <input type="text" for="data_fim" name="data_fim" style="width: 80px" value="{{ $estagio->data_fim->format('d/m/Y') }}">,
                cujas atividades serão desenvolvidas na Unidade Concedente, no horário das
                <input type="time" for="hora_inicial" name="hora_inicial" value="{{$dados['hora_inicial'] ?? ''}}"> às
                <input type="time" for="hora_final" name="hora_final" value="{{$dados['hora_final'] ?? ''}}">, totalizando
                <input type="number" min="1" for="quant_semanas" name="quant_semanas" style="width: 50px" value="{{$dados['quant_semanas'] ?? ''}}"> semanais.
            </p>

            <p>Visualize as outras cláusulas realizando o download do documento original clicando <a
                    href="">aqui.</a> </p>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>

        </form>
    </div>
@endsection
