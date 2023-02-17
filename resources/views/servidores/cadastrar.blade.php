@extends("templates.app")

@section("body")
<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px">

@if (session('sucesso'))
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
@endif
<br>
    <div class="d-flex justify-content-center align-items-center">
        <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color:#2D3875;">
                Cadastrar Servidor</h2>
            <hr style="color:#2D3875;">
                <form action="{{route('servidores.store')}}" method="POST" class="row needs-validation" novalidate style="text-align:start;">
                    @csrf
                    @method("POST")

                    <div class="row">
                        <div class="col-12 mb-3" style="padding-top: 12px;">
                            <label for="nome" class="titulo">Nome:</label>
                            <input type="text" class="boxinfo" name="nome" id="nome" required placeholder="Digite o nome">
                        </div>

                        <div class="col-12">
                            <label for="inputNomeSocial" class="titulo">Nome Social:</label>
                            <input type="text" class="boxinfo" id="inputNomeSocial" required name="nome_social" placeholder="Digite o nome social"><br><br>
                        </div>

                        <div class="col-12 mb-3">

                            <label for="tipo_servidor" class="titulo" >Tipo do servidor: </label>
                            <select name="tipo_servidor" id="tipo_servidor" class="boxinfo" required aria-label="Default select example">
                                <option value="">Selecione o tipo de servidor</option>

                                @foreach ($tipo_servidores as $tipo_servidor)
                                    <option value="{{$tipo_servidor->id}}">{{$tipo_servidor->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="cpf" class="titulo">CPF:</label>
                            <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF" class="boxinfo">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="email" class="titulo">E-mail:</label>
                            <input type="text" name="email" id="email" placeholder="Digite o E-mail" class="boxinfo">
                        </div>
                
                        <div class="col-12 mb-3">
                            <label for="senha" class="titulo">Senha:</label>
                            <input type="password" name="senha" id="senha" placeholder="Digite a senha" class="boxinfo">

                        </div>
                        <br>
                    </div>

                    <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                        <input type="button" value="Voltar" href="{{url("/servidores/")}}" onclick="window.location.href='{{url("/servidores/")}}'"
                        style="background: #2D3875; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                        border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                        line-height: 29px; text-align: center; padding: 5px 15px;">
                        <input type="submit" name="salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                        display: inline-block;
                        border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal; font-weight: 400; font-size: 24px;
                        line-height: 29px; text-align: center; padding: 5px 15px;" value="Salvar">
                    </div>
                </form>

        </div>
    </div>


<script type="text/javascript">

</script>
</div>
<style>
    .btn{
        box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.25);
        border-radius: 6px;
        width: 170px;
    }
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

    .card.card-cadastro{
        border-radius: 20px;
        width: 700px;
    }
    .form-label{
        display:flex;
        font-weight: 600;
        font-size: 20px;
        line-height: 28px;
        color: 131833;
    }

    /* Css da tela de Cadastrar servidor */
    .form-select{
        border-radius: 8px;
        box-shadow: inset 0px 1px 5px rgba(0, 0, 0, 0.25);
        text-align: start;
        padding-right: 12px;
        font-family: 'Roboto', sans-serif;
    }
</style>
@endsection
