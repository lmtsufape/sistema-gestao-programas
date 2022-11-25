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

<form action="{{route("orientadors.store")}}" method="POST">
    @csrf
    <label for="nome">Nome: </label>
    <input type="text" name="nome" id="nome"><br><br>

    <label for="email">email: </label>
    <input type="text" name="email" id="email"><br><br>

    <label for="senha">senha: </label>
    <input type="password" name="senha" id="senha"><br><br>

    <label for="cpf">CPF: </label>
    <input type="text" name="cpf" id="cpf"><br><br>

    <label for="matricula">Matrícula: </label>
    <input type="text" name="matricula" id="matricula"><br><br>

    <input type="submit" value="salvar">
</form>