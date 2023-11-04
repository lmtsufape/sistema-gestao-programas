@extends("templates.app")

@section('body')

@canany(['admin', 'servidor', 'gestor'])

<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom: 10px; flex-direction: column;">
    @if (session('sucesso'))
        <div class="alert alert-success" style="width: 100%;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Verificar Aluno</h1>
        </div>

        <br>

        <form action="{{ route('estagio.verificarAluno.control') }}" method="POST">
            @csrf
            @method("POST")
        
            <label class="input-informacao" for="cpf">Digite o CPF do Aluno</label>
            <input class="boxcadastrar" type="text" name="cpf" id="cpf" required>
        
            <br>
            <br>
        
            <div class="botoessalvarvoltar">
                <input class="botaosalvar" type="submit" value="Próximo">
            </div>
        </form>
        
    </div>
</div>

@endcan

@endsection
