@extends("templates.app")

@section("body")

@if (session('sucesso'))
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
@endif

<div class="d-flex justify-content-center align-items-center">
    <div class="container-fluid p-5" style="margin: auto; font-family: 'Roboto', sans-serif;">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card card-cadastro bg-white shadow">
                <div class="card-body p-5">
                    <form class="row needs-validation" novalidate style="text-align:start;" action="{{url('/servidores/'. strval($servidor->id))}}" method="post">
                        @csrf
                        @method("PUT")
                        <h2 class="fw-bold mb-3 text-start">Editar Servidor</h2>
                        <hr>
                        <div class="row">
                            <div class="col-12 mb-3" style="padding-top: 12px;">
                                <label for="nome" class="form-label">Nome</label>
                                <input name="nome" type="text" placeholder="Digite o nome" class="form-control bg-light" value="{{$servidor->user->name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cpf_editar" class="form-label">CPF</label>
                                <input name="cpf" id="cpf" type="text" placeholder="Digite o CPF" class="form-control bg-light" value="{{$servidor->cpf}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="tipo_servidor_editar" style="font-size:14.4px;">Tipo do servidor: </label>
                                <select class="form-select bg-light" aria-label="Default select example" name="tipo_servidor"  id="tipo_servidor">
                                    @foreach ($tipo_servidores as $tipo_servidor)
                                        <option value="{{$tipo_servidor->id}}" {{$tipo_servidor->id == $servidor->id ? 'selected' : ''}}>{{$tipo_servidor->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email_editar" class="form-label">E-mail</label>
                                <input name="email" type="text" placeholder="Digite o e-mail" class="form-control bg-light" value="{{$servidor->user->email}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_editar" class="form-label">Senha</label>
                                <input name="password" type="password" placeholder="Digite a senha" class="form-control bg-light">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4" style="padding-right:48px;">
                            <a href="{{url("/servidores")}}" class="btn btn-secondary">Voltar <a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cpf").mask("999.999.999-99");
	});
</script>
<style>
    .btn{
        box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.25);
        border-radius: 13px;
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

    .form-control{
        border-radius: 8px;
        box-shadow: inset 0px 1px 5px rgba(0, 0, 0, 0.25);
        text-align: start;
        font-size: 16px;
    }

    .card.card-cadastro{
        border-radius: 20px;
        width: 700px;
    }
    .form-label{
        font-size: 0.9rem;
    }

    /* CSS editar servidor */
    .form-select{
        border-radius: 8px;
        box-shadow: inset 0px 1px 5px rgba(0, 0, 0, 0.25);
        text-align: start;
        padding-right: 12px;
        font-family: 'Roboto', sans-serif;
    }
</style>
@endsection
