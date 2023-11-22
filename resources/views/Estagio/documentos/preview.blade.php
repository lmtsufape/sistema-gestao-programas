@extends('templates.app')

@section('body')
    <br><br>


    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">
                Pré-visualização do documento:
                {{ $documento->lista_documentos_obrigatorios->titulo . ' - ' . $documento->aluno->nome_aluno }}</h1>
            <h2 class="titulopequeno">- Alguns elementos do documento podem encontrar-se fora de posição ou ocultos devido à
                pré-visualização.</h2>
            <h2 class="titulopequeno">- Realize o download no final da página para visualização completa.</h2>
        </div>

        <div class= "border border-dark rounded row d-flex justify-content-center" id="container"></div>

        <br><br>
        <div class="botoessalvarvoltar">
            <button class="botaovoltar" id="botaoVoltar" alt="Voltar / Fechar janela" title="Voltar / Fechar janela"
                onclick="window.close()">Voltar</button>
            <a class="botaosalvar" style="color:white" href="{{ route('download.doc', ['docId' => $documento->id]) }}"
                title="Realizar o download em .docx">Download</a>
        </div>

    </div>


    <!--dependencies-->
    <script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/docx-preview@0.1.15/dist/docx-preview.js"></script>
    <script>
        // Recupera o conteúdo do PHP e converte para Uint8Array
        var conteudoArrayBytes = new Uint8Array({!! json_encode($conteudoArrayBytes) !!});

        // Cria um Blob a partir do Uint8Array
        var blob = new Blob([conteudoArrayBytes]);

        // Opções para a renderização (se necessário)
        var options = {
            breakPages: true,
            inWrapper: false,
        };

        // Chama a função renderAsync
        docx.renderAsync(blob, document.getElementById("container"), null, options)
            .then(x => console.log("docx: finished"));
    </script>
@endsection
