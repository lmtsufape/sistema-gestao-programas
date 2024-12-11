@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Formulário de frequência do residente na concedente</h1>
        </div>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UPE.frequencia-residente', ['id' => $estagio->id]) }}"method="post">
            @csrf


            <label for="residente" class="titulopequeno">Nome do residente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="residente" id="residente"
                value="{{ $dados['residente'] ?? '' }}" 
                placeholder="Digite o nome do residente"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="curso" class="titulopequeno">Curso do residente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" value="{{ $dados['curso'] ?? '' }}"
                placeholder="Digite o curso do residente"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="unidade" class="titulopequeno">Unidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="unidade" id="unidade" value="{{ $dados['unidade'] ?? '' }}"
                placeholder="Digite a unidade"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="nomeConcedente" class="titulopequeno">Nome da Concedente<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nomeConcedente" id="nomeConcedente"
                value="{{ $dados['nomeConcedente'] ?? '' }}" 
                placeholder="Digite o nome da concedente"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="etapaEducacaoBasica" class="titulopequeno">Etapa da educação básica<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="etapaEducacaoBasica" id="etapaEducacaoBasica"
                value="{{ $dados['etapaEducacaoBasica'] ?? '' }}" 
                placeholder="Digite a etapa da educação básica"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="ano" class="titulopequeno">Ano<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="ano" id="ano" value="{{ $dados['ano'] ?? '' }}"
                placeholder="Digite o ano"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="nomeProf" class="titulopequeno">Nome do/a docente preceptor/a<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nomeProf" id="nomeProf" value="{{ $dados['nomeProf'] ?? '' }}"
                placeholder="Digite o nome do/a docente preceptor/a"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="numMatricula" class="titulopequeno">N° da matrícula do/a docente preceptor/a<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="numMatricula" id="numMatricula"
                value="{{ $dados['numMatricula'] ?? '' }}"
                placeholder="Digite o n° da matrícula do/a docente preceptor/a"
                required><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <p>Este formulário facilita o preenchimento do seu documento para maior comodidade. Pedimos que baixe o
                documento já preenchido e, ao final do estágio, por favor, envie-o integralmente. Agradecemos pela sua
                colaboração.</p>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            


        </form>

    </div>
    </div>
@endsection
