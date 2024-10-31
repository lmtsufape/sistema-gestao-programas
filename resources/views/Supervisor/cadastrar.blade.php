@extends("templates.app")

@section("body")
<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:3.6em;">
    @can('cadastrar supervisor')
        @if (session('sucesso'))
            <div class="alert alert-success">
                {{session('sucesso')}}
            </div>
        @endif
        <div class="fundocadastrar">
            <h1 class="titulogrande">
                Cadastrar Supervisor</h1>
            <hr class="divisor">
                <form action="{{route('supervisor.store')}}" method="POST" class="row needs-validation" novalidate style="text-align:start;" enctype="multipart/form-data">
                    @csrf
                    @method("POST")

                    <div style="display:flex; flex-direction: column;">

                            <label for="nome" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
                            <input type="text" name="nome" id="nome" placeholder="Digite o nome" class="boxcadastrar" value="{{ old('nome') }}">

                            <label for="cpf" class="titulopequeno" required >CPF<strong style="color: #8B5558">*</strong></label>
                            <input class="boxcadastrar cpf-autocomplete" type="text" name="cpf" id="cpf" placeholder="Digite o CPF" class="boxcadastrar" value="{{ old('cpf') }}">

                            <label for="email" class="titulopequeno">E-mail<strong style="color: #8B5558">*</strong></label>
                            <input type="text" name="email" id="email" placeholder="Digite o E-mail" class="boxcadastrar" value="{{ old('email') }}">

                            <label for="telefone" class="titulopequeno">Telefone<strong style="color: #8B5558">*</strong></label>
                            <input class="boxcadastrar telefone-autocomplete" type="text" name="telefone" id="telefone" placeholder="Digite o telefone" value="{{ old('telefone') }}">

                            <label for="formacao" class="titulopequeno">Formacao<strong style="color: #8B5558">*</strong></label>
                            <input type="text" name="formacao" id="formacao" placeholder="Digite a formação" class="boxcadastrar" value="{{ old('formacao') }}">

                        <br>
                    </div>

                    <div class="container-botoes">
                        <input type="button" value="Voltar" href="{{url("/supervisor/")}}" onclick="window.location.href='{{url("/supervisor/")}}'"
                        class="botaovoltar">

                        <input type="submit" value="Cadastrar" class="botaosalvar">
                    </div>
                </form>

        </div>



        <script type="text/javascript">

        </script>
        </div>
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
                display:flex;
                font-weight: 600;
                font-size: 20px;
                line-height: 28px;
                color: 131833;
            }

            /* Css da tela de Cadastrar Supervisor */
            .form-select{
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

            .form-check{
                margin-right: 35px;
            }

            .radios{
                margin:5px;
            }
        </style>
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
    @endcan

<script  src="{{ mix('js/app.js') }}">
    $('.cpf-autocomplete').inputmask('999.999.999-99');
</script>

<script  src="{{ mix('js/app.js') }}">
    $('.telefone-autocomplete').inputmask('(99)99999-9999');
</script>
@endsection
