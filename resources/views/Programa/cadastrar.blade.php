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
      /* select single */
      .required .chosen-single {
        background: #F5F5F5;
        border-radius: 5px;
        border: 1px #D3D3D3;
        padding: 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }
    /* select multiple */
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
        background: #F5F5F5;
        border-radius: 6px;
        border: 1px #D3D3D3;
        width: 100%;
        padding: 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);

    }
    .boxchild{
        background: #FFFFFF;
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        padding: 34px;
        width: 65%
    }
</style>

@canany(['admin', 'pro_reitor'])
    <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <br>
        <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
            Cadastrar Programa</h1>
            <hr>

            <form action="{{route('programas.store')}}" method="post">
                @csrf

                <label for="nome" class="titulo">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome do programa" class="boxinfo"><br><br>

                <label for="descricao" class="titulo">Descricao:</label>
                <input type="text" name="descricao" id="descricao" placeholder="Digite a descrição do programa" class="boxinfo"><br><br>

                <label class="titulo" for="servidor">Servidor:</label>
                    <select aria-label="Default select example" class="boxinfo" name="servidor" id="servidor" >
                        <option value=""></option>
                            @foreach ($servidors as $servidor)
                                <option value="{{$servidor->id}}" style="color: black; border-radius: 5px;">{{$servidor->user->name}}</option>
                            @endforeach
                    </select><br><br
                
                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                    <input type="button" value="Voltar" href="{{url('/programas/')}}" onclick="window.location.href='{{url('/programas/')}}'" style="background: #2D3875;
                                box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                line-height: 29px; text-align: center; padding: 5px 15px;">
                    <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                        display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                        font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                </div>
            </form>
        </div>
    </div>

        <script>
            $("#servidors").chosen({
            placeholder_text_multiple: "Selecione um servidor",
            // max_shown_results : 5,
            no_results_text: "Não possui alunos."
        });
            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
        </script>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection
