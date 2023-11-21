@extends('templates.app')

@section('body')
    @canany(['admin', 'servidor', 'gestor'])

        <div class="container-fluid"
            style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom: 10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{ session('sucesso') }}
                </div>
            @endif

            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Editar observação</h1>
                </div>

                <br>

                <form action="{{ route('observacao.update', ['id' => $doc->id]) }}" method="POST">
                    @csrf
                    @method('POST')

                    <label class="input-informacao" for="observacao">Observação</label>
                    <input class="boxcadastrar" type="text" name="observacao" id="observacao" class="form-control"
                        value="{{ $doc->observacao }}" required>

                    <br>
                    <br>

                    <div class="botoessalvarvoltar">
                        <a href="{{ route('estagio.documentos', ['id' => $doc->estagio_id]) }}" class="botaovoltar">Voltar</a>
                        <input class="botaosalvar" type="submit" value="Salvar">
                    </div>
                </form>
            </div>
        </div>

    @endcan
@endsection
