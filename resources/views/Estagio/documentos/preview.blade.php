@extends('templates.app')

@section('body')
    <div id="container"></div>

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
        };

        // Chama a função renderAsync
        docx.renderAsync(blob, document.getElementById("container"), null, options)
            .then(x => console.log("docx: finished"));
    </script>
@endsection
