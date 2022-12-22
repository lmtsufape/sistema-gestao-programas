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
    <div class="alert alert-success">
        {{session('sucesso')}}
    </div>
@endif

<div class="d-flex justify-content-center align-items-center">
    <div class="container-fluid p-5" style="margin: auto; font-family: 'Roboto', sans-serif;">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card card-cadastro bg-white shadow">
                <div class="card-body p-5">
                    <form action="{{route('servidores.store')}}" method="POST" class="row needs-validation" novalidate style="text-align:start;">
                        @csrf
                        @method("POST")
                        <h2 class="fw-bold mb-3 text-start">Cadastrar Servidor</h2>
                        <hr>
                        <div class="row">
                            <div class="col-12 mb-3" style="padding-top: 12px;">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" placeholder="Digite o nome" class="form-control bg-light" >
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-6 mb-3">
                                 <label for="cpf" class="form-label">CPF</label>
                                <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF" class="form-control bg-light">    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" name="email" id="email" placeholder="Digite o E-mail" class="form-control bg-light">
                            </div>                        
                        </div>   
                        <div class="row">
                            <div class="col-md-6 md-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" id="senha" placeholder="Digite a senha" class="form-control bg-light">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipo_servidor" class="mb-2" style="font-size:14.4px;">Tipo do servidor: </label>
                                <select name="tipo_servidor" id="tipo_servidor" class="form-select bg-light" aria-label="Default select example">
                                    <option value="adm">Administrador</option>
                                    <option value="pro_reitor">Pró-reitor</option>
                                    <option value="servidor">Servidor</option>
                                </select>
                            </div>    
                        </div>                
                        <div class="d-flex justify-content-between align-items-center mt-4" style="padding-right:48px;">
                            <a href="#" class="btn btn-secondary">Voltar <a>
                            <input type="submit" name="salvar" class="btn btn-primary">
                        </div>
                    </form>
                </div>    
            </div>    
        </div>
    </div>
</div>
<script type="text/javascript">

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
