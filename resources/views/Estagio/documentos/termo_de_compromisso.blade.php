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
                id="ProfessorComponenteCurricular" required><br><br>

            <label for="instituicaoEmail" class="titulopequeno">E-mail da Instituição</label>
            <br>
            <input class="boxcadastrar" type="email" name="instituicaoEmail" id="instituicaoEmail" required><br><br>

            <label for="orientador" class="titulopequeno">Orientador</label>
            <br>
            <input class="boxcadastrar" type="text" name="orientador" id="orientador"
                value="{{ $orientador->user->name }}" readonly style="background: #eee; " required><br><br>

            <label for="emailOrientador" class="titulopequeno">E-mail do Orientador</label>
            <br>
            <input class="boxcadastrar" type="email" name="emailOrientador" id="emailOrientador"
                value="{{ $orientador->user->email }}" readonly style="background: #eee; " required><br><br>

            <!-- UNIDADE CONCEDENTE -->
            <h1 class="titulogrande">Unidade concedente</h1>

            <label for="instituicaoUnidadeConcedente" class="titulopequeno">Unidade Concedente</label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicaoUnidadeConcedente" id="instituicaoUnidadeConcedente"
                required><br><br>

            <label for="cnpj" class="titulopequeno">CNPJ</label>
            <br>
            <input class="boxcadastrar" type="text" name="cnpj" id="cnpj" required><br><br>

            <label for="localEstagio" class="titulopequeno">Local de Estágio</label>
            <br>
            <input class="boxcadastrar" type="text" name="localEstagio" id="localEstagio" required><br><br>

            <label for="localEstagio" class="titulopequeno">Endereço</label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco" id="endereco" required><br><br>

            <label for="localEstagio" class="titulopequeno">Número</label>
            <br>
            <input class="boxcadastrar" type="text" name="numero" id="numero" required><br><br>

            <label for="localEstagio" class="titulopequeno">Complemento</label>
            <br>
            <input class="boxcadastrar" type="text" name="complemento" id="complemento" required><br><br>

            <label for="localEstagio" class="titulopequeno">CEP</label>
            <br>
            <input class="boxcadastrar" type="text" name="cep" id="cep" required><br><br>

            <label for="localEstagio" class="titulopequeno">Bairro</label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro" id="bairro" required><br><br>

            <label for="localEstagio" class="titulopequeno">Cidade</label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade" id="cidade" required><br><br>

            <label for="localEstagio" class="titulopequeno">Estado</label>
            <br>
            <input class="boxcadastrar" type="text" name="estado" id="estado" required><br><br>

            <label for="localEstagio" class="titulopequeno">Representante legal</label>
            <br>
            <input class="boxcadastrar" type="text" name="representanteLegal" id="representanteLegal"
                required><br><br>

            <label for="localEstagio" class="titulopequeno">Cargo do representante</label>
            <br>
            <input class="boxcadastrar" type="text" name="cargoRepresentante" id="cargoRepresentante"
                required><br><br>

            <!-- SUPERVISOR -->
            <label for="supervisor" class="titulopequeno">Supervisor</label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisor" id="supervisor" required><br><br>

            <label for="cargoSupervisor" class="titulopequeno">Cargo do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="text" name="cargoSupervisor" id="cargoSupervisor" required><br><br>

            <label for="formacaoSupervisor" class="titulopequeno">Formação do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="text" name="formacaoSupervisor" id="formacaoSupervisor"
                required><br><br>

            <label for="cpfSupervisor" class="titulopequeno">CPF do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="text" name="cpfSupervisor" id="cpfSupervisor" required><br><br>

            <label for="emailSupervisor" class="titulopequeno">E-mail do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="email" name="emailSupervisor" id="emailSupervisor" required><br><br>

            <label for="telefoneSupervisor" class="titulopequeno">Telefone do Supervisor</label>
            <br>
            <input class="boxcadastrar" type="tel" name="telefoneSupervisor" id="telefoneSupervisor"
                required><br><br>

            <!-- ESTAGIÁRIO -->
            <h1 class="titulogrande">Dados do estagiário</h1>

            <label for="nomeAluno" class="titulopequeno">Nome do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="nomeAluno" id="nomeAluno" value="{{ $aluno->user->name }}"
                readonly style="background: #eee; " required><br><br>

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
            <input class="boxcadastrar" type="text" name="periodo" id="periodo" required><br><br>

            <label for="enderecoAluno" class="titulopequeno">Endereço do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="enderecoAluno" id="enderecoAluno" required><br><br>

            <label for="numeroEnderecoAluno" class="titulopequeno">Número do Endereço do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="numeroEnderecoAluno" id="numeroEnderecoAluno"
                required><br><br>

            <label for="complementoAluno" class="titulopequeno">Complemento do Endereço do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="complementoAluno" id="complementoAluno"><br><br>

            <label for="cepAluno" class="titulopequeno">CEP do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="cepAluno" id="cepAluno" required><br><br>

            <label for="bairroAluno" class="titulopequeno">Bairro do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="bairroAluno" id="bairroAluno" required><br><br>

            <label for="cidadeAluno" class="titulopequeno">Cidade do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="cidadeAluno" id="cidadeAluno" required><br><br>

            <label for="estadoAluno" class="titulopequeno">Estado do Aluno</label>
            <br>
            <input class="boxcadastrar" type="text" name="estadoAluno" id="estadoAluno" required><br><br>

            <label for="telefoneAluno" class="titulopequeno">Telefone do Aluno</label>
            <br>
            <input class="boxcadastrar" type="tel" name="telefoneAluno" id="telefoneAluno" required><br><br>

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
