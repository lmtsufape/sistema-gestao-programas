@extends("templates.app")

@section("body")

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{session('sucesso')}}
        </div>
    @endif
    <br>

    <form action="{{route('editals.store')}}" method="post">
        @csrf

        <label for="data_inicio">Data de início:</label>
        <input type="date" name="data_inicio" id="data_inicio"><br><br>

        <label for="data_fim">Data de fim:</label>
        <input type="date" name="data_fim" id="data_fim"><br><br>

        <label for="semestre">Semestre:</label>
        <input type="text" name="semestre" id="semestre"><br><br>

        <label for="programa">Programa:</label>
        <select name="programa" id="programa">
            <option value=""></option>
            @foreach ($programas as $programa)
                <option value="{{$programa->id}}">{{$programa->nome}}</option>
            @endforeach
        </select><br><br>

        <label for="curso">Cursos:</label>
        <select name="curso" id="curso">
            <option value=""></option>
            @foreach ($cursos as $curso)
                <option value="{{$curso->id}}">{{$curso->nome}}</option>
            @endforeach
        </select><br><br>

        <label for="orientadores">Orientadores:</label>
        <select name="orientadores[]" id="orientadores" multiple>
            <option value=""></option>
            @foreach ($orientadores as $orientador)
                <option value="{{$orientador->id}}">{{$orientador->user->name}}</option>
            @endforeach
        </select><br><br>

        <input type="submit" value="salvar">

    </form>

    <script>
        $("#programa").chosen({
            placeholder_text_single: "Selecione um programa",
            // max_shown_results : 5,
            no_results_text: "Não possui programas."
        });

        $("#curso").chosen({
            placeholder_text_single: "Selecione um curso",
            // max_shown_results : 5,
            no_results_text: "Não possui cursos."
        });

        $("#orientadores").chosen({
            placeholder_text_multiple: "Selecione um orientador",
            // max_shown_results : 5,
            no_results_text: "Não possui orientadores."
        });
    </script>

@endsection
