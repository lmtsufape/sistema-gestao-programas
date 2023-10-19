@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Relatório de Avaliação do Supervisor de Estágio</h1>
        </div>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.relatorio-supervisor.store', ['id' => $estagio->id]) }}"method="post" enctype="multipart/form-data">
            @csrf

            <label for="Arquivo" class="titulopequeno">Insira o documento já preenchido pelo Supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="file" name="arquivo" id="arquivo" required><br>
            <div class="invalid-feedback">Por favor, anexe um arquivo</div><br>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            


        </form>

    </div>
    </div>
@endsection
