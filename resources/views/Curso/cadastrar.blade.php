@extends("templates.app")

@section("body")
@canany(['admin', 'servidor', 'gestor'])

    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:10px; ">
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
                <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


                <br><br>
                <div class="botoessalvarvoltar">
                    <input type="button" value="Voltar" href="{{url('/home/')}}" onclick="window.location.href='{{url('/home/')}}'" class="botaovoltar">
                    <input class="botaosalvar" type="submit" value="Salvar">
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
