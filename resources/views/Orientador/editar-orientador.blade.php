@extends("templates.app")

@section("body")

<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px">

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{session('sucesso')}}
        </div>
    @endif
    <br>
    
    <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
        <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
            Editar orientador</h1>
            <hr>
        <form action="{{url("/orientadors/$orientador->id")}}" method="POST">
            @csrf
            @method("PUT")
            <label for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome" value="{{$orientador->user->name}}" 
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="email" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">E-mail:</label>
            <input type="text" id="email" name="email" placeholder="Digite o e-mail" value="{{$orientador->user->email}}" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="senha" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Digite a senha" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="cpf" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">CPF:</label>
            <input name="cpf" id="cpf" type="text" placeholder="Digite o CPF" value="{{$orientador->cpf}}" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="matricula" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Matrícula: </label>
            <input type="text" name="matricula" id="matricula" placeholder="Digite a matrícula" value="{{$orientador->matricula}}" 
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>

            <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                <input type="button" class="btn btn-secondary" value="Voltar" href="{{url("/orientadors/")}}" onclick="window.location.href='{{url("/orientadors/")}}'"
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
@endsection
