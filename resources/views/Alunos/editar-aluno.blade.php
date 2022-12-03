@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('sucesso'))
    <div class="alert alert-danger">
        {{session('sucesso')}}
    </div>
@endif
<br>

<form action="{{url("/alunos/$aluno->id")}}" method="POST">
    @csrf
    @method("PUT")
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="{{$aluno->user->name}}"><br/><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="{{$aluno->user->email}}"><br/><br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha"><br/><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="{{$aluno->cpf}}"><br/><br>

    <label for="curso">Curso:</label>
    <select name="curso" id="curso">
        @foreach ($cursos as $curso)
            <option value="{{$curso->id}}" {{$aluno->id_curso == $curso->id ? "selected" : ""}}>{{$curso->nome}}</option>
        @endforeach
    </select><br><br>

    <label for="semestre_entrada">Semestre de entrada:</label>
    <input type="text" id="semestre_entrada" name="semestre_entrada" value="{{$aluno->semestre_entrada}}"><br/><br>

    <input type="submit" value="editar">
</form>