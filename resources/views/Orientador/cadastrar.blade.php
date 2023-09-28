@extends("templates.app")

@section("body")


@canany(['admin', 'servidor'])
<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-bottom:10px; flex-direction: column;">
    @if (session('sucesso'))
    <div class="alert alert-success" style="width: 100%;">
        {{session('sucesso')}}
    </div>
    @endif
    <div class="fundocadastrar">
        <h1 class="titulogrande">
            Cadastrar Professor</h1>
        <hr class="divisor">

        <form action="{{route('orientadors.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image" class="titulopequeno">Imagem do Perfil</label>
            <div style="display: flex; flex-direction: row; gap:15px; margin-bottom:20px; align-items:center">
                <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 100px; height: 100px; border-radius: 50%;" />
                <input type="file" id="image" name="image" class="form-control boxinfo">
            </div>

            <label for="inputName" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar" type="text" id="inputName" name="name" required placeholder="Digite o nome" value="{{ old('name') }}">
            <div class="invalid-feedback">Por favor preencha esse campo</div><br>

            <label for="inputNomeSocial" class="titulopequeno">Nome Social</label>
            <input class="boxcadastrar" type="text" id="inputNomeSocial" name="name_social" placeholder="Digite o nome social" value="{{ old('name_social') }}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="email" class="titulopequeno">E-mail<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar" type="text" name="email" id="email" placeholder="Digite o e-mail" value="{{ old('email') }}" required><br>

            <label for="cpf" class="titulopequeno">CPF<strong style="color: #8B5558">*</strong></label>
            <input class="boxinfo cpf-autocomplete" type="text" name="cpf" id="cpf" placeholder="Digite o CPF" value="{{ old('cpf') }}" required><br>
            <br>
            <label for="matricula" class="titulopequeno">Matrícula<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar" type="text" name="matricula" id="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)" value="{{ old('matricula') }}" required><br>

            <label class="titulopequeno" for="instituicaoVinculo">Intituição<strong style="color: #8B5558">*</strong></label>
            <div class="vinculo">

                <div class="form-check">
                    <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UFAPE" name="instituicaoVinculo" required>
                    <label class="textinho" for="instituicaoVinculo">Universidade Federal do Agreste de Pernambuco</label>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UPE" name="instituicaoVinculo" required>
                    <label class="textinho" for="instituicaoVinculo">Universidade de Pernambuco</label>
                </div>
            </div>
            <br>

            <label for="curso" class="titulopequeno">Curso(s) que Leciona<strong style="color: #8B5558">*</strong></label>
            <div class="form-check">
                @foreach ($cursos as $curso)
                <div class="col-md-6" style="display: flex; align-items: center; gap: 3%;">
                    <input type="checkbox" name="cursos[]" value="{{$curso->id}}" style="margin-bottom: 7px">
                    <label class="textinho">{{$curso->nome}}</label>
                </div>
                @endforeach
            </div>

            <label for="senha" class="titulopequeno" style="padding-top: 26px">Senha<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar" type="password" name="senha" id="senha" placeholder="Digite a senha" required><br><br>

            <div class="container-botoes">
                <input type="button" value="Voltar" href="{{url("/orientadors/")}}" onclick="window.location.href='{{url("/orientadors/")}}'" class="botaovoltar">

                <input type="submit" value="Salvar" class="botaosalvar">
            </div>
        </form>
    </div>
    <br>
    <br>
</div>
@elsecan
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url('/home')}}">Voltar</a>
@endcan
<script src="{{ mix('js/app.js') }}">
    $('.cpf-autocomplete').inputmask('999.999.999-99');
</script>

@endsection