@extends("templates.app")

@section("body")

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{session('sucesso')}}
        </div>
    @endif
    <br>

    <form action="{{url("/programas/$programa->id")}}" method="post">
        @csrf
        @method("PUT")
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="{{$programa->nome}}"><br><br>

        <label for="servidores">Servidores:</label>
        <select name="servidores[]" id="servidores" multiple>
            <option value=""></option>
            @foreach ($servidores as $servidor)
                <option value="{{$servidor->id}}" {{in_array($servidor->id, $idsServidoresDoPrograma) ? 'selected' : ''}}>{{$servidor->user->name}}</option>
            @endforeach
        </select><br><br>

        <input type="submit" value="salvar">

    </form>

    <script>
        $("#servidores").chosen({
        placeholder_text_multiple: "Selecione um servidor",
        // max_shown_results : 5,
        no_results_text: "Não possui alunos."
    });
    </script>

@endsection
