@extends("templates.app")

@section("body")
@canany(['admin', 'servidor'])
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


    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5rem; margin-bottom:10px; ">
        @if (session('sucesso'))
            <div class="alert alert-success">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div class="boxchild">
            <div class="row">
                <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #3D3434;">
                    Editar Curso</h1>
            </div>

            <hr style="color:#2D3875;">

            <form action="{{url("/cursos/$curso->id")}}"method="post">
                @csrf
                @method("put")

                <label for="nome" style="color:#3D3434" class="titulo">Nome<strong style="color: #8B5558 ">*</strong></label>
                <input class="boxinfo" type="text" name="nome" id="nome" placeholder="Digite o nome do curso" value="{{$curso->nome}}" >



                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%; padding-top: 15px;">

                    <input type="button" value="Voltar" href="{{url("/cursos/")}}" onclick="window.location.href='{{url("/cursos/")}}'" style="display: flex; width: 170px; padding: 10px; justify-content: center; align-items: center;
                                                                                                                                                gap: 10px; flex-shrink: 0; align-self: stretch; border-radius: 10px; border: 1px solid #DACFCF; color: #6B6B6B; font-family: Inter; background-color: white">
                   <input type="submit" value="Salvar" style="display: flex; width: 170px; height: 45px; padding: 10px; justify-content: center; align-items: center;
                                                                gap: 10px; flex-shrink: 0; border-radius: 10px; background: var(--green-g-200, #2B8C64); outline: none; border: #2B8C64; color: white; font-family: Inter;">

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
