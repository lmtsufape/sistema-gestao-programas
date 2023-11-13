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

            @can('aluno')
            <label for="curso" class="titulopequeno">Email<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="email" id="email" placeholder="Digite o email do estagiário" required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>
            @endcan

            @can('admin','servidor','gestor')
            <h1>oi</h1>
            @endcan

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            
        </form>
    </div>
@endsection