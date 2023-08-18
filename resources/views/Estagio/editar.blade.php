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

@canany(['admin', 'servidor'])
    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <br>
        <div class="boxchild">
            <div class="row">
                <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
                    Editar Estágio</h1>
            </div>
            <hr>

            <form action="{{ route('estagio.update', ['id' => $estagio->id]) }}" method="POST">
                @csrf
                @method("PUT")

                    <label class="titulo" for="Descrição">Descrição:</label>
                    <textarea class="boxinfo" name="descricao" id="descricao" cols="30" rows="5">{{ $estagio->descricao }}</textarea><br><br>

                    <label class="titulo" for="data_inicio">Data de início<strong style="color: #8B5558">*</strong></label>
                    <input class="boxinfo" type="date" name="data_inicio" id="data_inicio"
                        value="{{ $estagio->data_inicio->format('Y-m-d')}}"><br><br>

                    <label class="titulo" for="data_fim">Data de fim<strong style="color: #8B5558">*</strong></label>
                    <input class="boxinfo" type="date" name="data_fim" id="data_fim"
                        value="{{ $estagio->data_fim->format('Y-m-d')}}"><br><br>

                    <label class="titulo" for="data_solicitacao">Data de Solicitação<strong style="color: #8B5558">*</strong></label>
                    <input class="boxinfo" type="date" name="data_solicitacao" id="data_solicitacao"
                        value="{{ $estagio->data_solicitacao->format('Y-m-d') }}"><br><br>
                <br><br>

                <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">

                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                         <ul>
                            <li>{{ $errors->first('error') }}</li>
                         </ul>
                     </div>
                @endif

            </form>
        </div>
        <br>
        <br>
    </div>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan

@endsection
