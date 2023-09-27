@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Termo de encaminhamento</h1>
        </div>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.relatorio-acompanhamento-campo.store', ['id' => $estagio->id]) }}"method="post">
            @csrf


            <label for="nome" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso"
            
            <label for="natureza" class="titulopequeno">Natureza<strong style="color: #8B5558">*</strong></label>
            <br>
            <select name="natureza" id="natureza" class="boxcadastrar">
                <option value="publica">Pública</option>
                <option value="privada">Privada</option>
            </select>
            <br><br>    


            <br><br>
            <div class="botoessalvarvoltar">
                <input type="button" value="Voltar" href="{{ url('/home/') }}"
                    onclick="window.location.href='{{ url('/home/') }}'" class="botaovoltar">
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>


        </form>

    </div>
    </div>
@endsection
