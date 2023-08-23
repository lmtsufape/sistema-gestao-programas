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

        <form action="{{ route('estagio.documentos.termo-de-encaminhamento.store', ['id' => $estagio->id]) }}"method="post"
            target="_blank">
            @csrf


            <label for="nome" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome" id="nome" placeholder="Digite o nome do discente"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" placeholder="Digite o nome do curso"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Periodo<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo" placeholder="Digite o periodo do curso"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


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