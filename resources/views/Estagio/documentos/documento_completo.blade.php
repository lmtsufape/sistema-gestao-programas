@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Documento - {{$lista_documento->titulo}}</h1>
            <h2 class="titulopequeno">Você deve fazer o download do documento e reenvia-lo com as assinaturas preenchidas.</h2>
        </div>
        <br>
        <a class="cadastrar-botao" style="text-decoration: none; color: white; margin-right: 10px" type="button"
            href="{{ route('visualizar.pdf', ['id' => $documento->id]) }}" target="_blank">Fazer o download de: {{ $lista_documento->titulo }}</a>
        <br>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.documento-completo.store', ['id' => $documento->id]) }}"method="post" enctype="multipart/form-data">
            @csrf

            <label for="Arquivo" class="titulopequeno">Insira o documento completo<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="file" name="arquivo" id="arquivo" required><br>
            <div class="invalid-feedback">Por favor, anexe o arquivo preenchido com as assinaturas</div><br>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $documento->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            
        </form>

    </div>
    </div>
@endsection