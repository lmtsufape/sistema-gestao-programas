@if (session('sucesso'))
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
@endif

<form action="{{route('cursos.store')}}"method="post">
    @csrf
    

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" placeholder="Digite o nome do curso">

    <input type="submit" value="salvar">



</form>