@extends("templates.app")

@section("body")
@can('editar curso')
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
        .titulo {
            font-weight: 600;
            font-size: 20px;
            line-height: 28px;
            display: flex;
            color: #131833;
        }
        .boxinfo{
            display: flex;
            height: 43px;
            padding: 13px 10px;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 10px;
            align-self: stretch;
            border-radius: 7px;
            border: 1px solid
            var(--preto-p-50, #E6E6E6);
        }
        .boxchild{
            display: flex;
            width: 796px;
            flex-direction: column;
            justify-content: center;
            align-items: stretch;
            gap: 10px;
            border-radius: 10px;
            border: 1px solid var(--preto-p-50, #E6E6E6);
            box-shadow: none;
        }

    </style>


    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
        @if (session('sucesso'))
            <div class="alert alert-success">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                <h1 class="titulogrande">Editar Curso</h1>
            </div>

            <br>

            <form action="{{url("/cursos/$curso->id")}}"method="post">
                @csrf
                @method("put")

                <label for="nome" style="color:#3D3434" class="titulopequeno">Nome<strong style="color: #8B5558 ">*</strong></label>
                <input class="boxcadastrar" type="text" name="nome" id="nome" placeholder="Digite o nome do curso" value="{{$curso->nome}}" >
                <br><br>
               
                <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{url("/cursos/")}}" onclick="window.location.href='{{url("/cursos/")}}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
            </div>


            </form>

        </div>
    </div>


    <!-- <script>
        $("#disciplinas").chosen({
                placeholder_text_multiple: "Selecione uma disciplina",
                // max_shown_results : 5,
                no_results_text: "Não possui disciplinas."
            });

            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
    </script> -->
@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection
