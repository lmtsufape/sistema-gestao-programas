@extends('templates.app')

@section('body')
    @can('configurar estagio')
        <div class="container-fluid"
            style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>

            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Configurar estágios</h1>
                </div>
                <hr style="color:#5C1C26; background-color: #5C1C26">
                <form action="{{ route('estagio.updateConfig') }}" method="POST">
                    @csrf
                    <h2 class="titulopequeno">Configurar data limite dos documentos:</h3>
                        <br>
                    <div class="form-group">
                        <label class="titulopequeno" for="novaData">Alterar todas as datas</label>
                        <input class="boxcadastrar" type="date" class="form-control" id="novaData"
                            onchange="atualizarDatas(this.value)">
                    </div>
                    @foreach ($documentos as $documento)
                        <div class="form-group">
                            <label class="titulopequeno" for="{{ $documento->id }}">{{ $documento->titulo }}</label>
                            <input class="boxcadastrar" type="date" class="form-control" name="{{ $documento->id }}"
                                value="{{ $documento->data_limite }}">
                        </div>
                    @endforeach
                    <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{ url('/estagio/') }}"
                            onclick="window.location.href='{{ url('/estagio/') }}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    @endcan
    <script>
        function atualizarDatas(novaData) {
            let inputsData = document.querySelectorAll('input[type="date"]:not(#novaData)');
            inputsData.forEach(function(input) {
                input.value = novaData;
            });
        }
    </script>
@endsection
