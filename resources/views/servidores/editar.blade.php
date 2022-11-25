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

<form action="{{url("servidores/$servidor->id")}}" method="POST">
    @csrf
    @method("PUT")
    <label for="nome">Nome: </label>
    <input type="text" name="nome" id="nome" value="{{$servidor->user->name}}"><br><br>

    <label for="email">email: </label>
    <input type="text" name="email" id="email" value="{{$servidor->user->email}}"><br><br>

    <label for="senha">senha: </label>
    <input type="password" name="senha" id="senha"><br><br>

    <label for="cpf">CPF: </label>
    <input type="text" name="cpf" id="cpf" value="{{$servidor->cpf}}"><br><br>

    <label for="tipo_servidor">Tipo do servidor: </label>
    <select name="tipo_servidor" id="tipo_servidor">
        <option value="adm" {{$servidor->tipo_servidor == "adm" ? "selected" : ""}}>Administrador</option>
        <option value="pro_reitor" {{$servidor->tipo_servidor == "pro_reitor" ? "selected" : ""}}>Pró-reitor</option>
        <option value="servidor" {{$servidor->tipo_servidor == "servidor" ? "selected" : ""}}>Servidor</option>
    </select><br><br>

    <input type="submit" value="salvar">
</form>