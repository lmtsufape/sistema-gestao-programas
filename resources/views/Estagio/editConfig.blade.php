@extends('templates.app')

@section('body')
    @canany(['admin', 'servidor', 'pro_reitor', 'gestor'])
        <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{session('sucesso')}}
                </div>
            @endif
            <br>

            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Configurar Estágios</h1>
                </div>
                <hr style="color:#5C1C26; background-color: #5C1C26">
                <form action="{{ route('estagio.updateConfig') }}" method="POST">
                    @csrf
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
@endsection
