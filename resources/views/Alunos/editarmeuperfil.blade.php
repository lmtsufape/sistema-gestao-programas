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
        <form action="{{ route('alunos.update', compact('aluno') )}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div style="display: flex; flex-direction: row; gap:15px; margin-bottom:20px">
                @if($aluno->user->image)
                <img src="/images/fotos-perfil/{{ $aluno->user->image }}" alt="Foto Perfil" style="width: 80px; height: 80px; border-radius:50px;"/>
                @else
                <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 8.77rem; border-radius: 50%; margin-top: 2rem; margin-bottom: 1rem;"/>
                @endif
                    <div style="align-self:flex-end">
                    <input type="file" id="image" name="image" class="form-control boxcadastrar">
                    </div>
                </div>

            <label for="name_social" class="titulopequeno">Nome Social</label>
            <input type="text" id="name_social" name="name_social" value="{{$aluno->user->name_social}}" class="boxcadastrar">
            <br>

            <label for="name" class="titulopequeno">Nome Completo<strong style="color: #8B5558">*</strong></label>
            <input type="text" id="name" name="name" required value="{{$aluno->user->name}}"class="boxcadastrar">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>

            <label for="email" class="titulopequeno">E-mail<strong style="color: #8B5558">*</strong></label>
            <input type="text" id="email" name="email" required value="{{$aluno->user->email}}" class="boxcadastrar">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>

            <label for="cpf" for="nome" class="titulopequeno">CPF<strong style="color: #8B5558">*</strong></label>
            <input type="text" id="cpf" name="cpf" required value="{{$aluno->user->cpf}}" class="boxcadastrar cpf-autocomplete">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>

            <label for="curso" for="nome" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <select name="curso" id="curso" class="boxcadastrar">
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" {{$aluno->curso_id == $curso->id ? "selected" : ""}}>{{$curso->nome}}</option>
                @endforeach
            </select>
            <br>

            <label for="semestre_entrada" for="nome" class="titulopequeno">Semestre de entrada<strong style="color: #8B5558">*</strong></label>
            <input type="text" id="semestre_entrada" name="semestre_entrada" value="{{$aluno->semestre_entrada}}" class="boxcadastrar">
            <br>

            <label for="senha" for="nome" class="titulopequeno">Senha<strong style="color: #8B5558">*</strong></label>
            <input type="password" id="senha" required name="senha" class="boxcadastrar">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br>
            <br>

            <div class="botoessalvarvoltar" style="justify-content: start">
                <input class="botaovoltar" type="button" value="Voltar" href="{{url('/meu-perfil-aluno/')}}" onclick="window.location.href='{{url('/meu-perfil-aluno/')}}'">
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
</div>

<script  src="{{ mix('js/app.js') }}">


    $('.cpf-autocomplete').inputmask('999.999.999-99');

</script>
@endsection
