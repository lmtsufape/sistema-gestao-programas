@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Termo de encaminhamento</h1>
        </div>

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.formularios.termo_encaminhamento.store') }}"method="post">
            @csrf


            <label for="nome" class="titulopequeno">Nome:<strong style="color: red">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome" id="nome" placeholder="Digite o nome do discente"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Curso:<strong style="color: red">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" placeholder="Digite o nome do curso"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Periodo:<strong style="color: red">*</strong></label>
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
