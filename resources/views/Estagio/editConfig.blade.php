@extends('templates.app')

@section('body')
    @canany(['admin', 'servidor', 'pro_reitor', 'gestor'])
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success" style="width: 100%;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="">
                        <br><br>
                        <div class="titulogrande">Configurar Estágios</div>
                        <br><br>
                        <div>
                            <form action="{{ route('estagio.updateConfig') }}" method="POST">
                                @csrf
                                @foreach ($documentos as $documento)
                                    <div class="form-group">
                                        <label for="{{ $documento->id }}">{{ $documento->titulo }}</label>
                                        <input type="date" class="form-control" name="{{ $documento->id }}"
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
                </div>
            </div>
        </div>
    @endcan
@endsection
