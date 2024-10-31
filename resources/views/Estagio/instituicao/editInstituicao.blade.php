@extends("templates.app")

@section('body')

@can('editar instituicao estagio')

<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom: 10px; flex-direction: column;">
    @if (session('sucesso'))
        <div class="alert alert-success" style="width: 100%;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Editar instituição</h1>
        </div>

        <br>

        <form action="{{ route('instituicao.update') }}" method="POST">
            @csrf
            @method("POST")

                <label class="titulopequeno" for="nome">Instituição:</label>
                <input class="boxcadastrar" type="text" name="instituicao" id="instituicao" class="form-control" value="{{ $instituicao->instituicao }}" required>

            
                <label class="titulopequeno" for="sigla">Sigla:</label>
                <input class="boxcadastrar" type="text" name="sigla" id="sigla" class="form-control" value="{{ $instituicao->sigla }}" required>

            
                <label class="titulopequeno" for="sigla">CNPJ:</label>
                <input class="boxcadastrar" type="text" name="cnpj" id="cnpj" class="form-control" value="{{ $instituicao->cnpj }}" required>

            
                <label class="titulopequeno" for="sigla">Natureza jurídica da instituição:</label>
                <input class="boxcadastrar" type="text" name="natureza_juridica" id="natureza_juridica" class="form-control" value="{{ $instituicao->natureza_juridica }}" required>

            
                <label class="titulopequeno" for="sigla">Endereço:</label>
                <input class="boxcadastrar" type="text" name="endereco" id="endereco" class="form-control" value="{{ $instituicao->endereco }}" required>

            
                <label class="titulopequeno" for="sigla">Número:</label>
                <input class="boxcadastrar" type="text" name="numero" id="numero" class="form-control" value="{{ $instituicao->numero }}" required>

            
                <label class="titulopequeno" for="sigla">Complemento:</label>
                <input class="boxcadastrar" type="text" name="complemento" id="complemento" class="form-control" value="{{ $instituicao->complemento }}" required>

            
                <label class="titulopequeno" for="sigla">CEP:</label>
                <input class="boxcadastrar" type="text" name="CEP" id="CEP" class="form-control" value="{{ $instituicao->CEP }}" required>

            
                <label class="titulopequeno" for="sigla">Bairro:</label>
                <input class="boxcadastrar" type="text" name="bairro" id="bairro" class="form-control" value="{{ $instituicao->bairro }}" required>

            
                <label class="titulopequeno" for="sigla">Cidade:</label>
                <input class="boxcadastrar" type="text" name="cidade" id="cidade" class="form-control" value="{{ $instituicao->cidade }}" required>

            
                <label class="titulopequeno" for="sigla">Estado:</label>
                <input class="boxcadastrar" type="text" name="estado" id="estado" class="form-control" value="{{ $instituicao->estado }}" required>

            
                <label class="titulopequeno" for="sigla">Representante:</label>
                <input class="boxcadastrar" type="text" name="representante" id="representante" class="form-control" value="{{ $instituicao->representante }}" required>

            
                <label class="titulopequeno" for="sigla">Cargo do representante:</label>
                <input class="boxcadastrar" type="text" name="cargo_representante" id="cargo_representante" class="form-control" value="{{ $instituicao->cargo_representante }}" required>

                <br>
                <br>

            <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{ route('instituicao.index')}}" onclick="window.location.href='{{ route("instituicao.index")}}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
</div>

@endcan

@endsection
