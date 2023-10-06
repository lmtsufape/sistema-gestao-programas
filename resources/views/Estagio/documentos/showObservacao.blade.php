@extends("templates.app")

@section('body')

@canany(['aluno'])

<div class="fundocadastrar">
    <div class="container-fluid">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Observação</h1>
        </div>

        <br>

        <form action="{{ route('observacao.show', ['id' => $doc->id]) }}"method="post">
            @csrf
            
            <label class="input-informacao" for="">Observação</label>
            <p class="output-informacao">{{ $doc->observacao }}</p>

        </form>

        <br>
        <br>

        </div>
        </div>
    </div>
</div>

@endcan
@endsection