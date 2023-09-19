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

        <form action="{{ route('estagio.documentos.termo-de-compromisso.store', ['id' => $estagio->id]) }}" method="post">
            @csrf

            <!-- INSTITUIÇÃO DE ENSINO -->
            <h1 class="titulogrande">Instituição de ensino</h1>

            <label for="ProfessorComponenteCurricular" class="titulopequeno">Professor Componente Curricular</label>
            <br>
            <input class="boxcadastrar" type="text" name="ProfessorComponenteCurricular"
                id="ProfessorComponenteCurricular" value="{{ $dados['professorComponenteCurricular'] ?? '' }}"
                required><br><br>

            <label for="instituicaoEmail" class="titulopequeno">E-mail da Instituição</label>
            <br>
            <input class="boxcadastrar" type="email" name="instituicaoEmail" id="instituicaoEmail"
                value="{{ $dados['instituicaoEmail'] ?? '' }}" required><br><br>

            <label for="orientador" class="titulopequeno">Orientador</label>
            <br>
            <input class="boxcadastrar" type="text" name="orientador" id="orientador"
                value="{{ $orientador->user->name }}" readonly style="background: #eee; "
                value="{{ $dados['instituicaoEmail'] ?? '' }}" required><br><br>

            <label for="emailOrientador" class="titulopequeno">E-mail do Orientador</label>
            <br>
            <input class="boxcadastrar" type="email" name="emailOrientador" id="emailOrientador"
                value="{{ $orientador->user->email }}" readonly style="background: #eee; " required><br><br>

            <!-- UNIDADE CONCEDENTE -->
            <h1 class="titulogrande">Unidade concedente</h1>

            <label for="cnpj" class="titulopequeno">CNPJ</label>
            <br>
            <input class="boxcadastrar" type="text" name="cnpj" id="cnpj" value="{{ $dados['cnpj'] ?? '' }}"
                required><br><br>

            <label for="localEstagio" class="titulopequeno">Local de Estágio</label>
            <br>
            <input class="boxcadastrar" type="text" name="localEstagio" id="localEstagio"
                value="{{ $dados['localEstagio'] ?? '' }}" required><br><br>

            <label for="endereco" class="titulopequeno">Endereço</label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco" id="endereco" value="{{ $dados['endereco'] ?? '' }}"
                required><br><br>

            <label for="numero" class="titulopequeno">Número</label>
            <br>
            <input class="boxcadastrar" type="text" name="numero" id="numero" value="{{ $dados['numero'] ?? '' }}"
                required><br><br>

            <label for="complemento" class="titulopequeno">Complemento</label>
            <br>
            <input class="boxcadastrar" type="text" name="complemento" id="complemento"
                value="{{ $dados['complemento'] ?? '' }}" required><br><br>

            <label for="cep" class="titulopequeno">CEP</label>
            <br>
            <input class="boxcadastrar" type="text" name="cep" id="cep" value="{{ $dados['cep'] ?? '' }}"
                required><br><br>

            <label for="bairro" class="titulopequeno">Bairro</label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro" id="bairro" value="{{ $dados['bairro'] ?? '' }}"
                required><br><br>

            <label for="cidade" class="titulopequeno">Cidade</label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade" id="cidade" value="{{ $dados['cidade'] ?? '' }}"
                required><br><br>

            <label for="estado" class="titulopequeno">Estado</label>
            <br>
            <input class="boxcadastrar" type="text" name="estado" id="estado"
                value="{{ $dados['estado'] ?? '' }}" required><br><br>

            <label for="representanteLegal" class="titulopequeno">Representante legal</label>
            <br>
            <input class="boxcadastrar" type="text" name="representanteLegal" id="representanteLegal"
                value="{{ $dados['representanteLegal'] ?? '' }}" required><br><br>

            <label for="cargoRepresentante" class="titulopequeno">Cargo do representante</label>
            <br>
            <input class="boxcadastrar" type="text" name="cargoRepresentante" id="cargoRepresentante"
                value="{{ $dados['cargoRepresentante'] ?? '' }}" required><br><br>

            <!-- SUPERVISOR -->
            <label for="cargoSupervisor" class="titulopequeno">Cargo do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="text" name="cargoSupervisor" id="cargoSupervisor"
                value="{{ $dados['cargoSupervisor'] ?? '' }}" required><br><br>

            <label for="formacaoSupervisor" class="titulopequeno">Formação do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="text" name="formacaoSupervisor" id="formacaoSupervisor"
                value="{{ $dados['formacaoSupervisor'] ?? '' }}" required><br><br>

            <label for="cpfSupervisor" class="titulopequeno">CPF do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="text" name="cpfSupervisor" id="cpfSupervisor"
                value="{{ $dados['cpfSupervisor'] ?? '' }}" required><br><br>

            <label for="emailSupervisor" class="titulopequeno">E-mail do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="email" name="emailSupervisor" id="emailSupervisor"
                value="{{ $dados['emailSupervisor'] ?? '' }}" required><br><br>

            <label for="telefoneSupervisor" class="titulopequeno">Telefone do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="tel" name="telefoneSupervisor" id="telefoneSupervisor"
                value="{{ $dados['telefoneSupervisor'] ?? '' }}" required><br><br>

            <!-- ESTAGIÁRIO -->
            <h1 class="titulogrande">Dados do estagiário</h1>

            <label for="nomeAluno" class="titulopequeno">Nome do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="nomeAluno" id="nomeAluno"
                value="{{ $aluno->user->name }}" readonly style="background: #eee; " required><br><br>

            <label for="cpfAluno" class="titulopequeno">CPF do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="cpfAluno" id="cpfAluno" value="{{ $aluno->user->cpf }}"
                readonly style="background: #eee; " required><br><br>

            <label for="curso" class="titulopequeno">Curso</label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" value="{{ $aluno->curso->nome }}"
                readonly style="background: #eee; " required><br><br>

            <label for="periodo" class="titulopequeno">Período</label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo"
                value="{{ $dados['periodo'] ?? '' }}" required><br><br>

            <label for="enderecoAluno" class="titulopequeno">Endereço do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="enderecoAluno" id="enderecoAluno"
                value="{{ $dados['enderecoAluno'] ?? '' }}" required><br><br>

            <label for="numeroEnderecoAluno" class="titulopequeno">Número do Endereço do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="numeroEnderecoAluno" id="numeroEnderecoAluno"
                value="{{ $dados['numeroEnderecoAluno'] ?? '' }}" required><br><br>

            <label for="complementoAluno" class="titulopequeno">Complemento do Endereço do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="complementoAluno" id="complementoAluno"
                value="{{ $dados['complementoAluno'] ?? '' }}"><br><br>
            <label for="cepAluno" class="titulopequeno">CEP do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="cepAluno" id="cepAluno"
                value="{{ $dados['cepAluno'] ?? '' }}" required><br><br>

            <label for="bairroAluno" class="titulopequeno">Bairro do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="bairroAluno" id="bairroAluno"
                value="{{ $dados['bairroAluno'] ?? '' }}" required><br><br>

            <label for="cidadeAluno" class="titulopequeno">Cidade do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="cidadeAluno" id="cidadeAluno"
                value="{{ $dados['cidadeAluno'] ?? '' }}" required><br><br>

            <label for="estadoAluno" class="titulopequeno">Estado do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="estadoAluno" id="estadoAluno"
                value="{{ $dados['estadoAluno'] ?? '' }}" required><br><br>

            <label for="telefoneAluno" class="titulopequeno">Telefone do Aluno</label>
            <br>
            <input class="boxcadastrar" type="tel" name="telefoneAluno" id="telefoneAluno"
                value="{{ $dados['telefoneAluno'] ?? '' }}" required><br><br>

            <label for="emailAluno" class="titulopequeno">E-mail do Aluno</label>
            <br>
            <input class="boxcadastrar" type="email" name="emailAluno" id="emailAluno"
                value="{{ $aluno->user->email }}" readonly style="background: #eee; " required><br><br>

            <br><br>
            <div class="botoessalvarvoltar">
                <input type="button" value="Voltar" onclick="window.location.href='{{ url('/home/') }}'"
                    class="botaovoltar">
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
@endsection
