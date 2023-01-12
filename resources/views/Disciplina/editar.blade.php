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

<form action="{{url("disciplinas/$disciplina->id")}}" method="POST">
    @csrf
    @method("PUT")
    <label for="nome">Nome: </label>
    <input type="text" name="nome" id="nome" value="{{$disciplina->nome}}"><br><br>
    <input type="submit" value="salvar">
</form>