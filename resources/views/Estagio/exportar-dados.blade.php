<!-- resources/views/export_estagio.blade.php -->

@extends('templates.app')

@section('body')
    @can('exportar dados estagio')
        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                <h1 class="titulogrande">Exportar dados dos estágios</h1>
            </div>

            <hr style="color:#5C1C26; background-color: #5C1C26">

            <form action="{{ route('estagio.export') }}" method="GET" id="exportForm">

                <div class="alert alert-info mt-3 w-50">
                    <p>Total de alunos cadastrados: {{ $alunos->count() }}</p>
                    <p>Total de estágios: {{ $estagios->count() }}</p>
                    <p>Total de estágios ativos: {{ $estagiosAtivos->count() }}</p>
                    <p>Total de alunos com estágio vinculado: {{ $alunosComEstagio->count() }}</p>
                </div>
                <br><br>

                <label for="status" class="titulopequeno">Status do Estágio</label><br>
                <select name="status" id="status" style="width: 30%">
                    <option value="">Todos</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select><br><br>

                <label for="tipo" class="titulopequeno">Tipo de Estágio</label><br>
                <select name="tipo" id="tipo" style="width: 30%">
                    <option value="">Todos</option>
                    <option value="eo">Estágio Obrigatório</option>
                    <option value="eno">Estágio Não Obrigatório</option>
                </select><br><br>


                <label for="inputCpf" class="titulopequeno">CPF do aluno</label>
                <input class="boxcadastrar cpf-autocomplete" type="text" id="inputCpf" name="cpf"
                    placeholder="Deixe em branco para buscar por todos os alunos." value="{{ isset($cpf) ? $cpf : old('cpf') }}"
                    {{ old('buscar_por_todos') ? 'disabled' : '' }}>

                @error('cpf')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="invalid-feedback"> Por favor, preencha esse campo</div>


                <label for="data_inicio" class="titulopequeno">Exportar estágios entre as datas</label>
                <p>Data inicial</p>
                <input class="" type="date" name="data_inicio" id="data_inicio"
                    placeholder="Digite a data de início do estágio">
                <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>
                <p>Data final</p>
                <input class="" type="date" name="data_fim" id="data_fim"
                    placeholder="Digite a data final do estágio"><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

                <label for="data_inicio" class="titulopequeno">Por curso</label><br>
                <select name="curso" id="curso">
                    <option value="">Todos os cursos</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endforeach
                </select><br><br>

                <label for="orietador" class="titulopequeno">Por orientador (CPF)</label><br>
                <input class="boxcadastrar cpf-autocomplete" type="text" id="inputCpf" name="orietador"
                    placeholder="Deixe em branco para buscar por todos os orietadores."
                    value="{{ isset($orietador) ? $orietador : old('orietador') }}"
                    {{ old('buscar_por_todos') ? 'disabled' : '' }}>

                <label for="extensao" class="titulopequeno">Formato do arquivo</label><br>
                <select name="extensao" id="extensao">
                    <option value="csv">.csv</option>
                    <option value="xlsx">.xlsx</option>
                    <option value="xls">.xls</option>
                    <option value="pdf">.pdf</option>
                    <option value="html">.html</option>
                </select><br><br>
                <br><br>
                <div class="botoessalvarvoltar">
                    <a href="{{ route('estagio.index') }}" class="botaovoltar">Voltar</a>
                    <input class="botaosalvar" type="submit" value="Exportar dados">
                </div>
            </form>
        </div>

    @endcan
@endsection
