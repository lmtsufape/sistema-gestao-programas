@extends("templates.app")
@section("body")
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('sucesso'))
    <div class="alert alert-danger">
        {{session('sucesso')}}
    </div>
@endif
<div class="d-flex justify-content-center align-items-center">
    <div class="container-fluid p-5" style="margin: auto; font-family: 'Roboto', sans-serif;">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card card-cadastro bg-white shadow">
                <div class="card-body p-5">                       
                    <form class="row needs-validation" novalidate style="text-align:start;" action="{{url('/orientadors/'. strval($orientador->id))}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$orientador->id}}">
                        @method("PUT")
                        <h2 class="fw-bold mb-3 text-start">Editar orientador</h2>
                        <hr>
                        <div class="row"> 
                            <div class="col-12 mb-3" style="padding-top: 12px;">                          
                                <label for="nome" class="form-label">Nome</label>
                                <input name="nome" type="text" placeholder="Digite o nome" class="form-control bg-light" value="{{$orientador->user->name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cpf_editar" class="form-label">CPF</label>
                                <input name="cpf" id="cpf" type="text" placeholder="Digite o CPF"  class="form-control bg-light" value="{{$orientador->cpf}}">
                            </div> 
                            <div class="col-md-6 mb-3">
                                <label for="matricula_editar" class="form-label">Matrícula</label>
                                <input name="matricula" type="text" placeholder="Digite a matrícula" class="form-control bg-light" value="{{$orientador->matricula}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email_editar" class="form-label">E-mail</label>
                                <input name="email" type="text" placeholder="Digite o e-mail" class="form-control bg-light" value="{{$orientador->user->email}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_editar" class="form-label">Senha</label>
                                <input name="password" type="password" placeholder="Digite a senha" class="form-control bg-light">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4" style="padding-right:48px;">
                            <a href="#" class="btn btn-secondary" id="botao1">Voltar <a>
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