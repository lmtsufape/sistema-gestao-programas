@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Ficha de Frequência</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UFAPE.ficha-frequencia.store', ['id' => $estagio->id]) }}" method="post">
            @csrf

            <!-- Campos com base no nome -->
            <label for="instituicao" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicao" id="instituicao"
                value="{{ $dados['instituicao'] ?? '' }}" placeholder="Digite o nome da instituição." required><br><br>

            <label for="nome_estagiario" class="titulopequeno">Nome do estagiário<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome_estagiario" id="nome_estagiario"
                value="{{ $aluno->nome_aluno }}" readonly style="background: #eee;"
                placeholder="Digite o nome do estagiário." required><br><br>

            <label for="empresa" class="titulopequeno">Nome da empresa<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="empresa" id="empresa" value="{{ $dados['empresa'] ?? '' }}"
                placeholder="Digite o nome da empresa." required><br><br>

            <label for="mes_ano_ref" class="titulopequeno">Mês e ano de referência<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="mes_ano_ref" id="mes_ano_ref"
                value="{{ $dados['mes_ano_ref'] ?? '' }}" placeholder="Digite mês e ano de referência." required><br><br>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" value="{{ $curso->nome }}"
                placeholder="Digite mês e ano de referência." readonly style="background: #eee;" required><br><br>

            <label for="matricula" class="titulopequeno">Matrícula<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="matricula" id="matricula"
                value="{{ $dados['matricula'] ?? '' }}" placeholder="Digite a matrícula." required><br><br>

            <label for="cnpj" class="titulopequeno">CNPJ<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cnpj" id="cnpj" value="{{ $dados['cnpj'] ?? '' }}"
                placeholder="Digite o CNPJ da empresa." required><br><br>

            <div id="checkTipo">
                <label class="titulopequeno" for="checkTipo">Tipo do estágio: <strong
                        style="color: #8B5558">*</strong></label>
                <br>
                @if ($estagio->tipo == 'eo')
                    <input type="radio" name="checkTipo" value="eo" checked required>
                    <label class="textinho" for="checkTipo_obrigatorio">Obrigatório</label>
                    <br>
                    <input type="radio" name="checkTipo" value="eno" required>
                    <label class="textinho" for="checkTipo_nao_obrigatorio">Não obrigatório</label><br><br>
                @else
                    <input type="radio" name="checkTipo" value="eo" required>
                    <label class="textinho" for="checkTipo_obrigatorio">Obrigatório</label>
                    <br>
                    <input type="radio" name="checkTipo" value="eno" checked required>
                    <label class="textinho" for="checkTipo_nao_obrigatorio">Não obrigatório</label><br><br>
                @endif
            </div>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>

        </form>
    </div>
@endsection
