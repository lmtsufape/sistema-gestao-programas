@extends("templates.app")

@section("body")
<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:3.6em;">
    @canany(['admin', 'pro_reitor'])
        @if (session('sucesso'))
            <div class="alert alert-success">
                {{session('sucesso')}}
            </div>
        @endif
        <br>
            <div class="d-flex justify-content-center align-items-center">
                <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
                    <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
                        Cadastrar Servidor</h2>
                    <hr>
                        <form action="{{route('servidores.store')}}" method="POST" class="row needs-validation" novalidate style="text-align:start;" enctype="multipart/form-data">
                            @csrf
                            @method("POST")

                            <div class="row">

                                <div class="col-12 mb-3" style="padding-top: 12px;">
                                    <label for="image" class="form-label">Imagem do Perfil:</label>
                                    <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 150px; height: 150px; border-radius: 50%;"/>
                                    <input type="file" id="image" name="image" class="form-control-file">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="nome" class="form-label">Nome:<strong style="color: red">*</strong></label>
                                    <input type="text" name="nome" id="nome" placeholder="Digite o nome"
                                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" value="{{ old('nome') }}">
                                </div>


                                <div class="col-12 mb-3">
                                    <label for="nome_social" class="form-label">Nome social:</label>
                                    <input type="text" name="nome_social" id="nome_social" placeholder="Digite o nome social"
                                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" value="{{ old('name_social') }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="tipo_servidor" class="mb-2" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Tipo do servidor:<strong style="color: red">*</strong></label>
                                    <select name="tipo_servidor" id="tipo_servidor" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" aria-label="Default select example">
                                        <option value disabled selected hidden>Selecione um tipo de servidor</option>
                                        <option value="0">Administrador</option>
                                        <option value="1">Pró-Reitor</option>
                                        <option value="3">Gestor Institucional</option>
                                        <option value="2">Técnico Administrativo</option>                                        
                                        
                                    </select>
                                </div>


                                <div class="col-12 mb-3">
                                    <label for="cpf" class="form-label" required >CPF:<strong style="color: red">*</strong></label>
                                    <input class="boxinfo cpf-autocomplete" type="text" name="cpf" id="cpf" placeholder="Digite o CPF"
                                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" value="{{ old('cpf') }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="email" class="form-label">E-mail:<strong style="color: red">*</strong></label>
                                    <input type="text" name="email" id="email" placeholder="Digite o E-mail"
                                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" value="{{ old('email') }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label" for="instituicaoVinculo">Intituição:<strong style="color: red">*</strong></label>
                                    <div class="vinculo">
                                        
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UFAPE" name="instituicaoVinculo" required>
                                            <label class="form-check-label" for="instituicaoVinculo">Universidade Federal do Agreste de Pernambuco</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UPE" name="instituicaoVinculo" required>
                                            <label class="form-check-label" for="instituicaoVinculo">Universidade de Pernambuco</label>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="matricula" class="form-label">Matrícula:<strong style="color: red">*</strong></label>
                                    <input type="text" name="matricula" id="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)"
                                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" value="{{ old('matricula') }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="senha" class="form-label">Senha:<strong style="color: red">*</strong></label>
                                    <input type="password" name="senha" id="senha" placeholder="Digite a senha"
                                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);">
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

            /* Css da tela de Cadastrar servidor */
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
    @elsecan
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
    @endcan

<script  src="{{ mix('js/app.js') }}">
    $('.cpf-autocomplete').inputmask('999.999.999-99');
</script>
@endsection
