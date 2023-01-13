@extends("templates.app")

@section("body")
<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px">
    @if (session('sucesso'))
        <div class="alert alert-success">
            {{session('sucesso')}}
        </div>
    @endif
    <br>

    <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%">
            <div class="row">
                <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
                    Cadastrar Edital</h1>
            </div>

            <hr>

            <form action="{{route('editals.store')}}" method="post">
                @csrf

                <label for="data_inicio" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Data de início:</label>
                <input type="date" name="data_inicio" id="data_inicio"style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>

                <label for="data_fim" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Data de fim:</label>
                <input type="date" name="data_fim" id="data_fim" id="data_inicio"style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>

                <label for="semestre" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Semestre:</label>
                <input type="text" name="semestre" id="semestre" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>


                        <label for="programa" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Programa:</label>
                        <select name="programa" id="programa" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);">
                        <option value=""></option>
                        @foreach ($programas as $programa)
                            <option value="{{$programa->id}}">{{$programa->nome}}</option>
                        @endforeach
                        </select><br><br>

                        <label for="curso" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Curso:</label>
                        <select style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" name="curso" id="curso" >
                            <option value="">Selecione o curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->nome}}</option>
                            @endforeach
                        </select><br><br>

                <label for="orientadores" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Orientadores:</label>
                <select style="width: 100%; padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" name="orientadores[]" id="orientadores" multiple >
                    <option value=""></option>
                    @foreach ($orientadores as $orientador)
                        <option value="{{$orientador->id}}" style="color: black; border-radius: 5px; box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);">{{$orientador->user->name}}</option>
                    @endforeach
                </select><br><br>
                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                    <input type="button" value="Voltar" href="{{url("/editals/")}}" onclick="window.location.href='{{url("/editals/")}}'" style="background: #2D3875;
                                box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                line-height: 29px; text-align: center; padding: 5px 15px;">
                    <input type="submit" value="salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                    display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                    font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                </div>



            </form>
    </div>
</div>

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

        $('div.chosen-container-single').addClass('required');
        $('div.chosen-container-multi').addClass('required');
    </script>

@endsection
