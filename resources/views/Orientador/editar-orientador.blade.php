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
</style>

@canany(['admin', 'servidor'])
    <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">Editar Orientador</h1>
            <hr>
            <form action="{{url("/orientadors/$orientador->id")}}" method="POST">
                @csrf
                @method("PUT")
                <label for="nome" class="titulo">Nome:</label>
                <input class="boxinfo" type="text" id="nome" name="nome" placeholder="Digite o nome" value="{{$orientador->user->name}}"
                ><br/><br>

                <label for="email" for="nome" class="titulo">E-mail:</label>
                <input class="boxinfo" type="text" id="email" name="email" placeholder="Digite o e-mail" value="{{$orientador->user->email}}"><br/><br>

                <label for="senha" for="nome" class="titulo">Senha:</label>
                <input class="boxinfo" type="password" id="senha" name="senha" placeholder="Digite a senha"><br/><br>

                <label for="cpf" for="nome" class="titulo">CPF:</label>
                <input class="boxinfo" name="cpf" id="cpf" type="text" placeholder="Digite o CPF" value="{{$orientador->cpf}}" ><br/><br>

                <label for="matricula" class="titulo">Matrícula: </label>
                <input class="boxinfo" type="text" name="matricula" id="matricula" placeholder="Digite a matrícula" value="{{$orientador->matricula}}"><br><br>

                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                    <input type="button" class="btn btn-secondary" value="Voltar" href="{{url('/orientadors/')}}" onclick="window.location.href='{{url('/orientadors/')}}'"
                    style=" display: inline-block;
                    border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                    line-height: 29px; text-align: center; padding: 5px 15px;">
                    <input type="submit" class="btn btn-primary" value="Editar" style="box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                    display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                    font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                </div>
            </form>
        </div>
    </div>
    <style>
        .btn-primary{
        color: #fff;
        background-color: #34a853;
        border-color: #34a853;
        }
        .btn-primary:hover{
        background-color: #40b760;
        border-color: #40b760;
        }
        .btn-secondary{
        color: #fff;
        background-color: #2d3875;
        border-color: #2d3875;
        }
        .btn-secondary:hover{
        background-color: #4353ab;
        border-color: #4353ab;
        }
    </style>
@elsecan
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
@endcan
@endsection
