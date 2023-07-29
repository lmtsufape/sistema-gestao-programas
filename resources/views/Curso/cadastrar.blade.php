@extends("templates.app")

@section("body")
@canany(['admin', 'servidor', 'gestor'])

    <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:10px; ">
        @if (session('sucesso'))
            <div class="alert alert-success">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                <h1 class="titulogrande">Cadastrar Curso</h1>
            </div>

            <hr style="color:#5C1C26; background-color: #5C1C26">

            <form action="{{route('cursos.store')}}"method="post">
                @csrf


                <label for="nome" class="titulopequeno">Nome:<strong style="color: red">*</strong></label>
                <br>
                <input class="boxcadastrar" type="text" name="nome" id="nome" placeholder="Digite o nome do curso" required><br><br>


                <div style="display: flex; gap:5%">
                    {{--  <input type="button" value="Voltar" href="{{url('/home/')}}" onclick="window.location.href='{{url('/home/')}}'" style="background: #2D3875;
                                    box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                    border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                    line-height: 29px; text-align: center; padding: 5px 15px;">  --}}
                    <input class="botaosalvar" type="submit" value="Salvar" style="">
                </div>


            </form>

        </div>
    </div>



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
@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
