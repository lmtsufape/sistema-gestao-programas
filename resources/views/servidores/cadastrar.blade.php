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

<form action="{{route('servidores.store')}}" method="POST">
    @csrf

    <label for="nome">Nome: </label>
    <input type="text" name="nome" id="nome"><br><br>

    <label for="email">email: </label>
    <input type="text" name="email" id="email">

    <label for="senha">senha: </label>
    <input type="password" name="senha" id="senha"><br><br>

    <label for="cpf">CPF: </label>
    <input type="text" name="cpf" id="cpf"><br><br>

    <label for="tipo_servidor">Tipo do servidor: </label>
    <select name="tipo_servidor" id="tipo_servidor">
        <option value="adm">Administrador</option>
        <option value="pro_reitor">Pró-reitor</option>
        <option value="servidor">Servidor</option>
    </select><br><br>
    <input type="submit" name="salvar">
</form>