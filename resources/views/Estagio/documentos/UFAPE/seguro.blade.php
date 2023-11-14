@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Solicitação de Seguro</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UFAPE.seguro.store', ['id' => $estagio->id]) }}" method="post">
            @csrf


            @if (!isset($dados))
            <label for="curso" class="titulopequeno">Email<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="email" id="email" placeholder="Digite o email do estagiário" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="aluno_nome" class="titulopequeno">Nome do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="aluno_nome" id="aluno_nome" placeholder="Digite o nome do estagiário" value="{{ $aluno->nome_aluno }}" readonly required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            

            <label for="curso" class="titulopequeno">CPF<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cpf" id="cpf" placeholder="Digite o cpf do estagiário" value="{{ $aluno->cpf }}" readonly required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="data_nascimento" class="titulopequeno">Data de Nascimento<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="date" name="data_nascimento" id="data_nascimento" placeholder="Digite a data de nascimento do estagiário" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="sexo" class="titulopequeno">Sexo<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="text" name="sexo" id="sexo" placeholder="Digite o sexo do estagiário" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="curso"s class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" placeholder="Digite o curso do estagiário" value="{{ $curso->nome }}" readonly required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="inicio_estagio" class="titulopequeno">Início do Estágio<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="date" name="inicio_estagio" id="inicio_estagio" placeholder="Digite a data de início do estágio" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="termino_estagio" class="titulopequeno">Término do Estágio<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="date" name="termino_estagio" id="termino_estagio" placeholder="Digite a data de término do estágio" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="local_estagio" class="titulopequeno">Local do Estágio<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="text" name="local_estagio" id="local_estagio" placeholder="Digite o local do estágio" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="supervisor_estagio" class="titulopequeno">Supervisor do Estágio<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="text" name="supervisor_estagio" id="supervisor_estagio" placeholder="Digite o nome do supervisor do estágio" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="email_supervisor" class="titulopequeno">Email do Supervisor<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="text" name="email_supervisor" id="email_supervisor" placeholder="Digite o email do supervisor" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="email_orientador" class="titulopequeno">Email do Orientador<strong style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="text" name="email_orientador" id="email_orientador" placeholder="Digite o email do orientador" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="concordo">
                <input type="checkbox" name="concordo" id="concordo" value="sim" required>
                Ciente e de acordo que o Termo de Compromisso deverá ser providenciado antes da data de início do estágio e que a matrícula será confirmada após a entrega do Termo de Compromisso assinado por todas as partes.
            </label>
            

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>

            @else
            <label class="titulopequeno" for="email">Email</label>
            <input class="boxcadastrar" type="text" name="email" id="email" class="form-control" value="{{ $dados['email'] }}" readonly required>
            
            <label class="titulopequeno" for="aluno_nome">Nome do aluno</label>
            <input class="boxcadastrar" type="text" name="aluno_nome" id="aluno_nome" class="form-control" value="{{ $dados['aluno_nome'] }}" readonly required>
            
            <label class="titulopequeno" for="cpf">CPF</label>
            <input class="boxcadastrar" type="text" name="cpf" id="cpf" class="form-control" value="{{ $dados['cpf'] }}" readonly required>
            
            <label class="titulopequeno" for="data_nascimento">Data de Nascimento</label>
            <input class="boxcadastrar" type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{ $dados['data_nascimento'] }}" readonly required>
            
            <label class="titulopequeno" for="sexo">Sexo</label>
            <input class="boxcadastrar" type="text" name="sexo" id="sexo" class="form-control" value="{{ $dados['sexo'] }}" readonly required>
            
            <label class="titulopequeno" for="curso">Curso</label>
            <input class="boxcadastrar" type="text" name="curso" id="curso" class="form-control" value="{{ $dados['curso'] }}" readonly required>
            
            <label class="titulopequeno" for="inicio_estagio">Início do Estágio</label>
            <input class="boxcadastrar" type="date" name="inicio_estagio" id="inicio_estagio" class="form-control" value="{{ $dados['inicio_estagio'] }}" readonly required>
            
            <label class="titulopequeno" for="termino_estagio">Término do Estágio</label>
            <input class="boxcadastrar" type="date" name="termino_estagio" id="termino_estagio" class="form-control" value="{{ $dados['termino_estagio'] }}" readonly required>
            
            <label class="titulopequeno" for="local_estagio">Local do Estágio</label>
            <input class="boxcadastrar" type="text" name="local_estagio" id="local_estagio" class="form-control" value="{{ $dados['local_estagio'] }}" readonly required>
            
            <label class="titulopequeno" for="supervisor_estagio">Supervisor do Estágio</label>
            <input class="boxcadastrar" type="text" name="supervisor_estagio" id="supervisor_estagio" class="form-control" value="{{ $dados['supervisor_estagio'] }}" readonly required>
            
            <label class="titulopequeno" for="email_supervisor">Email do Supervisor</label>
            <input class="boxcadastrar" type="text" name="email_supervisor" id="email_supervisor" class="form-control" value="{{ $dados['email_supervisor'] }}" readonly required>
            
            <label for="concordo">
                <input type="checkbox" name="concordo" id="concordo" value="sim" checked disabled>
                Ciente e de acordo que o Termo de Compromisso deverá ser providenciado antes da data de início do estágio e que a matrícula será confirmada após a entrega do Termo de Compromisso assinado por todas as partes.
            </label>

            
            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
            </div>

            @endif
            
        </form>
    </div>
@endsection