@extends("templates.app")
@section("body")
<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:10em; flex-direction:column;">

    @if (session('sucesso'))
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
    @endif
    <br>

    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Editar Perfil</h1>
        </div>
        <form action="{{ route('meu-perfil-servidor.atualizar', ['id' => $servidor->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div style="display: flex; flex-direction: row; gap:15px; margin-bottom:20px">
                @if($servidor->user->image)
                <img src="/images/fotos-perfil/{{ $servidor->user->image }}" alt="Foto Perfil" style="width: 80px; height: 80px; border-radius:50px;" />
                @else
                <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 8.77rem; border-radius: 50%; margin-top: 2rem; margin-bottom: 1rem;" />
                @endif
                <div style="align-self:flex-end">
                    <input type="file" id="image" name="image" class="form-control boxinfo">
                </div>
            </div>

            <label class="titulopequeno" for="nome_social" for="nome">Nome Social</label>
            <input class="boxcadastrar" type="text" id="nome_social" name="nome_social" value="{{$servidor->user->name_social}}">
            <br>

            <label for="nome" class="titulopequeno">Nome Completo<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar" type="text" id="inputName" name="nome" required placeholder="Digite o nome" value="{{$servidor->user->name}}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>

            <label class="titulopequeno" for="email" for="nome">E-mail<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar" type="text" id="email" name="email" required placeholder="Digite o e-mail" value="{{$servidor->user->email}}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>

            <label class="titulopequeno" for="cpf" for="nome">CPF<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar boxinfo cpf-autocomplete" name="cpf" id="cpf" type="text" required placeholder="Digite o CPF" value="{{$servidor->cpf}}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>

            <label class="titulopequeno" for="senha" for="nome">Senha<strong style="color: #8B5558">*</strong></label>
            <input class="boxcadastrar" type="password" id="senha" name="senha" required placeholder="Digite a senha">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>
            <br>

            <div class="botoessalvarvoltar" style="justify-content: start">
                <input class="botaovoltar" type="button" value="Voltar" href="{{url("/meu-perfil-servidor/")}}" onclick="window.location.href='{{url("/meu-perfil-servidor/")}}'">
                <input class="botaosalvar" type="submit" value="Editar">
            </div>
        </form>
    </div>
</div>
<script src="{{ mix('js/app.js') }}">
    $('.cpf-autocomplete').inputmask('999.999.999-99');
</script>
@endsection