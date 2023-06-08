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
        padding-top: 10px;
    }
    .boxinfo {
        background: #F5F5F5;
        border-radius: 6px;
        border: 1px #D3D3D3;
        width: 100%;
        padding: 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
        text-align: start;
        margin-bottom: 10px; /* Add margin-bottom to create spacing */
    }
    .boxchild{
        background: #FFFFFF;
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        padding: 34px;
        width: 65%;
        margin-bottom: 2rem;
        margin-top: 2rem;
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

<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px">
    @if (session('sucesso'))
    <div class="alert alert-sucess">
        {{session('sucesso')}}
    </div>
    @endif

    <div class="boxchild">
        <div class="row">
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
                Cadastrar usuário</h1>
        </div>

        <hr style="color:#2D3875;">

        <form action="{{ route('store') }}" method="POST">
            @csrf
            <label for="nome" class="titulo">Nome:<strong style="color: red">*</strong></label>
            <input class="boxinfo" type="text" id="nome" name="nome" required placeholder="Digite o nome">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="nome_social" class="titulo">Nome Social:</label>
            <input class="boxinfo" type="text" id="nome_social" name="nome_social" placeholder="Digite o nome social">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cpf" class="titulo">CPF:<strong style="color: red">*</strong></label>
            <input class="boxinfo cpf-autocomplete" type="text"  id="cpf" name="cpf" required placeholder="Digite o CPF">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="email" class="titulo">E-mail:<strong style="color: red">*</strong></label>
            <input class="boxinfo" type="email" id="email" name="email" required placeholder="Digite o email">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="senha" class="titulo">Senha:<strong style="color: red">*</strong></label>
            <input type="password"  class="boxinfo" id="senha" name="senha" required placeholder="Digite a senha">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="tipoUser" class="titulo">Perfil:<strong style="color: red">*</strong></label>
            <select aria-label="Default select example" class="boxinfo" name="tipoUser" id="tipoUser">
                <option>Selecione o perfil</option>
                <option value="servidor">Técnico administrativo</option>
                <option value="orientador">Professor</option>
                <option value="aluno">Estudante</option>
            </select>

            <div id="instituicaoVinculo">
                <label class="titulo" for="instituicaoVinculo">Intituição:<strong style="color: red">*</strong></label>

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

            <div id="curso">
                <label class="titulo" for="curso">Curso:<strong style="color: red">*</strong></label>
                <select aria-label="Default select example" class="boxinfo" id="curso" name="curso">
                    <option value="">Selecione o curso</option>
                    @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                    @endforeach
                </select>

            </div>

            <div id="matricula">
                <label class="titulo" for="matricula">Matrícula:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" id="matricula" name="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)">
            </div>


            <div id="semestre">
                <label class="titulo" for="semestre_entrada">Semestre de entrada:<strong style="color: red">*</strong></label>
                <input class="boxinfo semestre-autocomplete" type="text"  id="semestre_entrada" name="semestre_entrada" placeholder="Digite o semestre (Exemplo: 2023.2)">
            </div>

            <br>

            <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                <a href="/">
                <input type="button" value="Voltar" style="background: #2D3875;
                            box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                            border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                            line-height: 29px; text-align: center; padding: 5px 15px;"/>
                </a>

                <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                            display: inline-block;
                            border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal; font-weight: 400; font-size: 24px;
                            line-height: 29px; text-align: center; padding: 5px 15px;"/>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ mix('js/app.js') }}">

    $('.semestre-autocomplete').inputmask('0000.0');
    $('.cpf-autocomplete').inputmask('999.999.999-99');

</script>

<script>
    $(document).ready(function() {
    $("#tipoUser").change(function() {
        var selectedOption = $(this).val();

        if (selectedOption == "aluno") {
            $("#curso").show();
            $("#semestre").show();
            $("#matricula").hide();
            $("#tipo_servidor").hide();
        } else if (selectedOption == "orientador") {
            $("#curso").hide();
            $("#semestre").hide();
            $("#matricula").show();
            $("#tipo_servidor").hide()
            $("#instituicaoVinculo").show();
            $("#curso").show();
        } else if (selectedOption == "servidor") {
            $("#curso").hide();
            $("#semestre").hide();
            $("#matricula").show();
            $("#tipo_servidor").show();
            $("#instituicaoVinculo").show();
        }
    });
});


</script>

@endsection
