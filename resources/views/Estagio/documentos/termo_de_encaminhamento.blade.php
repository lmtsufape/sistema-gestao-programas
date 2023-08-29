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

        <form action="{{ route('estagio.documentos.termo-de-encaminhamento.store', ['id' => $estagio->id]) }}"method="post">
            @csrf

            
            <label for="nome" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicao" id="instituicao" placeholder="Digite o nome da instituição onde será feito o estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

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

            <label for="nome" class="titulopequeno">Ano/Etapa/Modalidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="ano_etapa" id="ano_etapa" placeholder="Digite o Ano/Etapa/Modalidade do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Estágio Supervisionado<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="versao_estagio" id="versao_estagio" placeholder="Digite qual o Estágio Supervisionado"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Data de Início do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="data_inicio" id="data_inicio" placeholder="Digite qual a data e o mês de início do estágio EX: 23 de Ago"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Data de Fim do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="data_fim" id="data_fim" placeholder="Digite qual a data e o mês de fim do estágio EX: 23 de Ago"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="nome" class="titulopequeno">Ano do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="ano" id="ano" placeholder="Digite o Ano do estágio"
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
