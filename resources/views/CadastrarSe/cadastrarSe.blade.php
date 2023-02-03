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
    .boxchild{
        background: #FFFFFF;
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        padding: 34px;
        width: 65%
    }
</style>

<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px">

    @if (session('sucesso'))
    <div class="alert alert-sucess">
        {{session('sucesso')}}
    </div>
    @endif
    <br>

    <div class="boxchild">
        <div class="row">
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
                Cadastrar usuário</h1>
        </div>

        <hr>

        <form action="{{url("/cadastrar-se/store")}}" method="POST">
            @csrf
            <label for="inputName" class="titulo">Nome:</label>
            <input class="boxinfo" type="text" id="inputName" name="nome" required placeholder="Digite o nome">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="inputCpf" class="titulo">CPF:</label>
            <input class="boxinfo" type="text"  id="inputCpf" name="cpf" required placeholder="Digite o CPF">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="inputEmail4" class="titulo">Email:</label>
            <input class="boxinfo" type="email" id="inputEmail4" name="email" required placeholder="Digite o email">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="inputPassword4" class="titulo">Senha:</label>
            <input type="password"  class="boxinfo" id="inputPassword4" name="senha" required placeholder="Digite a senha">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="tipoUser" class="titulo">Tipo do usuário:</label>
            <select aria-label="Default select example" class="boxinfo" name="tipoUser" id="tipoUser">
                <option value="servidor" selected>Servidor</option>
                <option value="orientador">Orientador</option>
                <option value="aluno">Aluno</option>
            </select> <br><br>

            <div id="tipo_servidor">
                <label for="tipo_servidor" class="mb-2" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Tipo do servidor: </label>
                <select name="tipo_servidor" id="tipo_servidor" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" aria-label="Default select example">
                    <option value=""></option>
                    @foreach ($tipo_servidores as $tipo_servidor)
                        <option value="{{$tipo_servidor->id}}">{{$tipo_servidor->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div id="curso" hidden>
                <label class="titulo" for="cursoAluno">Curso:</label>
                <select aria-label="Default select example" class="boxinfo" id="curso" name="curso">
                    <option value="">Selecione o curso</option>
                    @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                    @endforeach
                </select>
                <br><br>
            </div>

            <div id="semestre" hidden>

                <label class="titulo" for="sementreEntradaAluno">Semestre de entrada:</label>
                <input class="boxinfo" type="text"  id="sementreEntradaAluno" name="ssementreEntradaAluno" placeholder="Digite o semestre">
                <br><br>
            </div>

            <div id="matriculaOri" hidden>
                <label class="titulo" for="matriculaOrientador">Matrícula:</label>
                <input class="boxinfo" type="text"  id="matriculaOrientador" name="matriculaOrientador" placeholder="Digite a matrícula">
                <br><br>
            </div>


            <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                <input type="button" value="Voltar" style="background: #2D3875;
                            box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                            border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                            line-height: 29px; text-align: center; padding: 5px 15px;"/>


                <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                            display: inline-block;
                            border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal; font-weight: 400; font-size: 24px;
                            line-height: 29px; text-align: center; padding: 5px 15px;"/>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#tipoUser").change(function() {
            if ($("#tipoUser").val() == "servidor") {
                $("#curso").attr("hidden", true);
                $("#semestre").attr("hidden", true);
                $("#matriculaOri").attr("hidden", true);
                $("#tipo_servidor").removeAttr("hidden");
            } else if ($("#tipoUser").val() == "orientador") {
                $("#curso").attr("hidden", true);
                $("#tipo_servidor").attr("hidden", true);
                $("#semestre").attr("hidden", true);
                $("#matriculaOri").removeAttr("hidden");
            } else {
                $("#curso").removeAttr("hidden");
                $("#tipo_servidor").attr("hidden", true);
                $("#semestre").removeAttr("hidden");
                $("#matriculaOri").attr("hidden", true);
            }
        });
    });

</script>

@endsection
