@extends("templates.app")

@section("body")

@canany(['admin', 'servidor', 'gestor'])
<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
    @if (session('sucesso'))
        <div class="alert alert-success" style="width: 100%;">
            {{session('sucesso')}}
        </div>
    @endif
    <br>
    <div class="fundocadastrar">
        <h1 class="titulogrande"> Estudantes</h1>
        <hr class="divisor">
        <form action="{{  route('alunos.update', ['id' => $aluno->id])  }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div style="display: flex; flex-direction: column;">
                <label for="perfil" class="titulopequeno">Foto de Perfil</label>
                @if($aluno->user->image)
                <img src="/images/fotos-perfil/{{ $aluno->user->image }}" alt="Foto Perfil" class="images"/>
                @else

                <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" class="images"/>
                @endif

                <input type="file" id="image" name="image" class="form-control boxcadastrar">
            </div>


            <label for="nome" class="titulopequeno">Nome<strong style="color: #996A6D">*</strong></label>
            <input type="text" id="nome" name="nome" value="{{$aluno->user->name}}"
            class="boxcadastrar">

            <label for="nome_social" class="titulopequeno">Nome Social</label>
            <input type="text" id="nome_social" name="nome_social" value="{{$aluno->user->name_social}}" class="boxcadastrar">

            <label for="email" for="nome" class="titulopequeno">E-mail<strong style="color: #996A6D">*</strong></label>
            <input type="text" id="email" name="email" value="{{$aluno->user->email}}" class="boxcadastrar">

            <label for="senha" for="nome" class="titulopequeno">Senha<strong style="color: #996A6D">*</strong></label>
            <input type="password" id="senha" name="senha" class="boxcadastrar">

            <label for="cpf" for="nome" class="titulopequeno">CPF<strong style="color: #996A6D">*</strong></label>
            <input type="text" id="cpf" name="cpf" value="{{$aluno->cpf}}" class="boxcadastrar cpf-autocomplete">

            <label for="curso" for="nome" class="titulopequeno">Curso<strong style="color: #996A6D">*</strong></label>
            <select name="curso" id="curso" class="boxcadastrar">
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" {{$aluno->curso_id == $curso->id ? "selected" : ""}}>{{$curso->nome}}</option>
                @endforeach
            </select>

            <label for="semestre_entrada" for="nome" class="titulopequeno">Semestre de entrada<strong style="color: #996A6D">*</strong></label>
            <input type="text" id="semestre_entrada" name="semestre_entrada" value="{{$aluno->semestre_entrada}}" class="boxcadastrar">

            <div class="botoessalvarvoltar">
                <input type="button" value="Voltar" href="{{url('/alunos/')}}" onclick="window.location.href='{{url('/alunos/')}}'"
                class="botaovoltar">

                <input type="submit" value="Salvar" class="botaosalvar">
            </div>
        </form>
    </div>
    <br>
    <br>
</div>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url('/home')}}">Voltar</a>
@endcan

<script  src="{{ mix('js/app.js') }}">


    $('.cpf-autocomplete').inputmask('999.999.999-99');

</script>
@endsection
