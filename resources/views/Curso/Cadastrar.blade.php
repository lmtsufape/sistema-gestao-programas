@extends("templates.app")

@section("body")
<style>
    select[multiple] {
        overflow: hidden;
        background: #f5f5f5;
        width:100%;
        height:auto;
        padding: 0px 5px;
        margin:0;
        border-width: 2px;
        border-radius: 5px;
        -moz-appearance: menulist;
        -webkit-appearance: menulist;
        appearance: menulist;
      }
      .required .chosen-choices {
        background: #F5F5F5;
        border-radius: 5px;
        border: 1px #D3D3D3;
        padding: 0px 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }
      </style>

    <form action="{{route('cursos.store')}}"method="post">
        @csrf
    

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Digite o nome do curso">
        <label for="disciplinas">Disciplinas:</label>
        <select name="disciplinas[]" id="disciplinas" multiple>
            <option value=""></option>
            @foreach ($disciplinas as $disciplina)
                <option value="{{$disciplina->id}}">{{$disciplina->nome}}</option>
            @endforeach
        </select><br><br>
        <input type="submit" value="salvar">
    </form>



    <script>
        $("#disciplinas").chosen({
                placeholder_text_multiple: "Selecione uma disciplina",
                // max_shown_results : 5,
                no_results_text: "Não possui disciplinas."
            });

            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
    </script>
@endsection