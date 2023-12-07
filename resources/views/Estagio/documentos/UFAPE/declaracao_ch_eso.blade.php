@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Declaração para Comprovação de Carga Horária realizada no Eso</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UFAPE.declaracao-ch-ufape.store', ['id' => $estagio->id]) }}"
            enctype="multipart/form-data" method="post">
            @csrf

            <label for="logomarca_empresa" class="titulopequeno">Logomarca da empresa<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="file" accept="image/*" name="logomarca_empresa" id="logomarca_empresa"
                required><br>

            <label for="aluno" class="titulopequeno">Nome do estagiário<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="aluno" id="aluno" value="{{ $aluno->nome_aluno }}"
                readonly style="background: #eee;" placeholder="Digite o nome do estagiário." required><br><br>

            <label for="cpf_aluno" class="titulopequeno">CPF do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cpf_aluno" id="cpf_aluno" value="{{ $aluno->cpf }}" readonly
                style="background: #eee;" required><br><br>

            <div id="checkTipo">
                <label class="titulopequeno" for="tipo_curso">Tipo do curso: <strong
                        style="color: #8B5558">*</strong></label>
                <br>
                <input type="radio" name="checkTipo" value="bach" required>
                <label class="textinho" for="checkTipo_obrigatorio">Bacharelado</label>
                <br>
                <input type="radio" name="checkTipo" value="lic" required>
                <label class="textinho" for="checkTipo_nao_obrigatorio">Licenciatura</label><br><br>
            </div>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="empresa" id="empresa" value="{{ $curso->nome }}"
                placeholder="Digite mês e ano de referência." readonly style="background: #eee;" required><br><br>

            <label for="empresa" class="titulopequeno">Empresa<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="empresa" id="empresa" value="{{ $dados['empresa'] ?? '' }}"
                placeholder="Digite o nome da empresa." required><br><br>

            <label for="data_inicio" class="titulopequeno">Data de início do estágio<strong
                    style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="date" name="data_inicio" id="data_inicio"
                value="{{ $estagio->data_inicio }}" placeholder="Digite a data de início do estágio" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="data_fim" class="titulopequeno">Data final do estágio<strong
                    style="color: #8B5558">*</strong></label><br>
            <input class="boxcadastrar" type="date" name="data_fim" id="data_fim" value="{{ $estagio->data_fim }}"
                placeholder="Digite a data final do estágio" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="carga_horaria" class="titulopequeno">Carga horária total<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="number" name="carga_horaria" id="carga_horaria"
                value="{{ $dados['carga_horaria'] ?? '' }}"
                placeholder="Digite a quantidade total da carga horária do estágio." required><br><br>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>

        </form>
    </div>
@endsection
