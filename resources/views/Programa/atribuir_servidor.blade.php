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

@can('vincular servidor-programa')
    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div class="fundocadastrar">
            <div class="row" style="align-content:left;">
                <h1 class="titulogrande"> Cadastrar Servidor no Programa {{$programa->nome}}</h1>
            </div>
            <br>

            <form action="{{route('programas.vincular-servidor')}}" method="post">
                @csrf

                <input type="hidden" name="id" value="{{$programa->id}}">
                @foreach ($servidors as $servidor)
                <div class="colunm" >
                    <div class="titulopequeno" style="display: flex; justify-items:center; gap:1%; align-items: flex-start; margin-bottom: 1%;">
                        <input type="checkbox" id="servidor_{{ $servidor->id }}" name="servidors[]" value="{{ $servidor->id }}">{{ $servidor->user->name }}
                    </div>
                </div>

                @endforeach
                <br><br>

                <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{url('/programas/')}}" onclick="window.location.href='{{url('/programas/')}}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            </form>
        </div>
        <br>
        <br>
    </div>

        <script>
            $("#servidors").chosen({
            placeholder_text_multiple: "Selecione um servidor",
            // max_shown_results : 5,
            no_results_text: "Não possui discente."
        });
            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
        </script>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection
