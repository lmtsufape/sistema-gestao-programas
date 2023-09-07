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

        <form action="{{ route('estagio.documentos.ficha-frequencia.store', ['id' => $estagio->id]) }}" method="post">
            @csrf

            <label for="campus" class="titulopequeno">Campus</label>
            <br> <input class="boxcadastrar" type="text" name="campus" id="campus" required><br><br>


            <br><br>
            <div class="botoessalvarvoltar">
                <input type="button" value="Voltar" onclick="window.location.href='{{ url('/home/') }}'"
                    class="botaovoltar">
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
@endsection
