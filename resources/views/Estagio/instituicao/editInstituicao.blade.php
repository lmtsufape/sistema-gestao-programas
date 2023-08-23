@extends("templates.app")

@section('body')

@canany(['admin', 'servidor', 'gestor', 'aluno'])

<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom: 10px; flex-direction: column;">
    @if (session('sucesso'))
        <div class="alert alert-success" style="width: 100%;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Editar Instituição</h1>
        </div>

        <hr style="color: #5C1C26; background-color: #5C1C26">

        <form action="{{ route('instituicao.update') }}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="nome">Instituição:</label>
                <input type="text" name="instituicao" id="instituicao" class="form-control" value="{{ $instituicao->instituicao }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Sigla:</label>
                <input type="text" name="sigla" id="sigla" class="form-control" value="{{ $instituicao->sigla }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">CNPJ:</label>
                <input type="text" name="cnpj" id="cnpj" class="form-control" value="{{ $instituicao->cnpj }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Natureza Jurídica da Instituição:</label>
                <input type="text" name="natureza_juridica" id="natureza_juridica" class="form-control" value="{{ $instituicao->natureza_juridica }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Endereço:</label>
                <input type="text" name="endereco" id="endereco" class="form-control" value="{{ $instituicao->endereco }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Número:</label>
                <input type="text" name="numero" id="numero" class="form-control" value="{{ $instituicao->numero }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $instituicao->complemento }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">CEP:</label>
                <input type="text" name="CEP" id="CEP" class="form-control" value="{{ $instituicao->CEP }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $instituicao->bairro }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $instituicao->cidade }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Estado:</label>
                <input type="text" name="estado" id="estado" class="form-control" value="{{ $instituicao->estado }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Representante:</label>
                <input type="text" name="representante" id="representante" class="form-control" value="{{ $instituicao->representante }}" required>
            </div>

            <div class="form-group">
                <label for="sigla">Cargo do Representante:</label>
                <input type="text" name="cargo_representante" id="cargo_representante" class="form-control" value="{{ $instituicao->cargo_representante }}" required>
            </div>


            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</div>

@endcan

@endsection
