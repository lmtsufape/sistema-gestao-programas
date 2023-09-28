@extends("templates.app")

@section("body")
<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:3.6em;">
    @canany(['admin', 'pro_reitor'])
    @if (session('sucesso'))
    <div class="alert alert-success" style="width: 100%;">
        {{session('sucesso')}}
    </div>
    @endif
    <div class="fundocadastrar">
        <h1 class="titulogrande">
            Cadastrar Servidor</h1>
        <hr class="divisor">
        <form action="{{route('servidores.store')}}" method="POST" class="row needs-validation" novalidate style="text-align:start;" enctype="multipart/form-data">
            @csrf
            @method("POST")

            <div style="display:flex; flex-direction: column;">

                <label for="image" class="titulopequeno">Imagem do Perfil</label>
                <div style="display: flex; flex-direction: row; gap:15px; margin-bottom:20px; align-items:center">
                    <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 100px; height: 100px; border-radius: 50%;" />
                    <input type="file" id="image" name="image" class="form-control boxinfo">
                </div>

                <label for="nome" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome" class="boxcadastrar" value="{{ old('nome') }}">

                <label for="nome_social" class="titulopequeno">Nome social</label>
                <input type="text" name="nome_social" id="nome_social" placeholder="Digite o nome social" class="boxcadastrar" value="{{ old('name_social') }}">

                <label for="tipo_servidor" class="titulopequeno">Tipo do servidor<strong style="color: #8B5558">*</strong></label>
                <select name="tipo_servidor" id="tipo_servidor" class="boxcadastrar" aria-label="Default select example">
                    <option value disabled selected hidden>Selecione um tipo de servidor</option>
                    <option value="0">Administrador</option>
                    <option value="1">Pró-Reitor</option>
                    <option value="3">Gestor Institucional</option>
                    <option value="2">Técnico Administrativo</option>

                </select>


                <label for="cpf" class="titulopequeno" required>CPF<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar cpf-autocomplete" type="text" name="cpf" id="cpf" placeholder="Digite o CPF" class="boxcadastrar" value="{{ old('cpf') }}">

                <label for="email" class="titulopequeno">E-mail<strong style="color: #8B5558">*</strong></label>
                <input type="text" name="email" id="email" placeholder="Digite o E-mail" class="boxcadastrar" value="{{ old('email') }}">

                <label class="titulopequeno" for="instituicaoVinculo">Intituição<strong style="color: #8B5558">*</strong></label>
                <div class="vinculo">

                    <div class="form-check">
                        <input type="radio" id="instituicaoVinculo" value="UFAPE" name="instituicaoVinculo" required>
                        <label class="textinho" for="instituicaoVinculo">Universidade Federal do Agreste de Pernambuco</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" id="instituicaoVinculo" value="UPE" name="instituicaoVinculo" required>
                        <label class="textinho" for="instituicaoVinculo">Universidade de Pernambuco</label>
                    </div>
                </div>
                <br>

                <label for="matricula" class="titulopequeno">Matrícula<strong style="color: #8B5558">*</strong></label>
                <input type="text" name="matricula" id="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)" class="boxcadastrar" value="{{ old('matricula') }}">


                <label for="senha" class="titulopequeno">Senha<strong style="color: #8B5558">*</strong></label>
                <input type="password" name="senha" id="senha" placeholder="Digite a senha" class="boxcadastrar">

                <br>
            </div>

            <div class="container-botoes">
                <input type="button" value="Voltar" href="{{url("/servidores/")}}" onclick="window.location.href='{{url("/servidores/")}}'" class="botaovoltar">

                <input type="submit" value="Editar" class="botaosalvar">
            </div>
        </form>

    </div>



    <script type="text/javascript">

    </script>
</div>
<style>
    .btn {
        box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.25);
        border-radius: 13px;
        width: 170px;
    }

    .btn-primary {
        color: #fff;
        background-color: #34a853;
        border-color: #34a853;
    }

    .btn-primary:hover {
        background-color: #40b760;
        border-color: #40b760;
    }

    .btn-secondary {
        color: #fff;
        background-color: #2d3875;
        border-color: #2d3875;
    }

    .btn-secondary:hover {
        background-color: #4353ab;
        border-color: #4353ab;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: inset 0px 1px 5px rgba(0, 0, 0, 0.25);
        text-align: start;
        font-size: 16px;
    }

    .card.card-cadastro {
        border-radius: 20px;
        width: 700px;
    }

    .form-label {
        display: flex;
        font-weight: 600;
        font-size: 20px;
        line-height: 28px;
        color: 131833;
    }

    /* Css da tela de Cadastrar servidor */
    .form-select {
        border-radius: 8px;
        box-shadow: inset 0px 1px 5px rgba(0, 0, 0, 0.25);
        text-align: start;
        padding-right: 12px;
        font-family: 'Roboto', sans-serif;
    }

    .vinculo {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .form-check {
        margin-right: 35px;
    }

    .radios {
        margin: 5px;
    }
</style>
@elsecan
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
@endcan

<script src="{{ mix('js/app.js') }}">
    $('.cpf-autocomplete').inputmask('999.999.999-99');
</script>
@endsection