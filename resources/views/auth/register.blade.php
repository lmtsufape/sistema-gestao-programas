@extends("templates.app")

@section("body")

<div class="container-fluid">
    @if (session('sucesso'))
    <div class="alert alert-sucess">
        {{session('sucesso')}}
    </div>
    @endif

    <div class="boxchild">
        <div class="row">
            <h1 class="main_title">
            Cadastrar usuário</h1>
        </div>

        <hr class="divisor">

        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- imagem de perfil

            <label for="image" class="titulo">Imagem do Perfil:</label>
            <img src="/images/fotos-perfil/sem-foto-perfil.png" alt="Foto Perfil" class="images" /><br>
            <div class="row d-flex justify-content-center">
                <div class="col-6 ">
                    <input type="file" id="image" name="image" class="form-control boxinfo">
                </div>
            </div> -->

            <label for="nome" class="titulo">Nome<strong style="color: red">*</strong></label>
            <input class="boxinfo" type="text" id="nome" name="nome" required placeholder="Digite o nome">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="nome_social" class="titulo">Nome Social</label>
            <input class="boxinfo" type="text" id="nome_social" name="nome_social" placeholder="Digite o nome social">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cpf" class="titulo">CPF<strong style="color: red">*</strong></label>
            <input class="boxinfo cpf-autocomplete" type="text"  id="cpf" name="cpf" required placeholder="Digite o CPF">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="email" class="titulo">E-mail<strong style="color: red">*</strong></label>
            <input class="boxinfo" type="email" id="email" name="email" required placeholder="Digite o email">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="senha" class="titulo">Senha<strong style="color: red">*</strong></label>
            <input type="password"  class="boxinfo" id="senha" name="senha" required placeholder="Digite a senha">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="tipoUser" class="titulo">Perfil<strong style="color: red">*</strong></label>
            <select aria-label="Default select example" class="boxinfo" name="tipoUser" id="tipoUser">
                <option value disabled selected hidden>Selecione o perfil</option>
                <option value="servidor">Técnico administrativo</option>
                <option value="orientador">Professor</option>
                <option value="aluno">Estudante</option>
            </select>

            <div id="instituicaoVinculo" style="display:none">
                <label class="titulo" for="instituicaoVinculo">Intituição de Vínculo<strong style="color: red">*</strong></label>
                <div class="vinculo">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UFAPE" name="instituicaoVinculo">
                        <label class="form-check-label" for="instituicaoVinculo">Universidade Federal do Agreste de Pernambuco</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UPE" name="instituicaoVinculo">
                        <label class="form-check-label" for="instituicaoVinculo">Universidade de Pernambuco</label>
                    </div>
                </div>
            </div>

            <div id="curso" style="display:none">
                <label class="titulo">Curso</label>
                <select aria-label="Default select example" class="boxinfo" name="curso" id="curso">
                    <option value disabled selected hidden>Selecione o curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div id="cursos" style="display:none">
                <label class="titulo">Curso(s) que Leciona</label>
                <div class="row">
                    @foreach ($cursos as $curso)
                    <div class="col-md-6" style="display: flex; justify-items:flex-start; gap:3%">
                        <input type="checkbox" name="cursos[]" value="{{$curso->id}}"> {{$curso->nome}}<br>
                    </div>
                    @endforeach
                </div>

            </div>


            <div id="matricula" style="display:none">
                <label class="titulo" for="matricula">Matrícula<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" id="matricula" name="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)">
            </div>


            <div id="semestre" style="display:none">
                <label class="titulo" for="semestre_entrada">Semestre de entrada<strong style="color: red">*</strong></label>
                <input class="boxinfo semestre-autocomplete" type="text"  id="semestre_entrada" name="semestre_entrada" placeholder="Digite o semestre (Exemplo: 2023.2)">
            </div>

            <br>
            <br>

            <div class="container-botoes">
                <a href="/">
                <input type="button" value="Voltar" class="botao-voltar"/>
                </a>

                <input type="submit" value="Cadastrar" class="botao-cadastrar"/>
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
                $("#cursos").hide();
                $("#matricula").hide();
                $("#tipo_servidor").hide();
                $("#instituicaoVinculo").hide();
            } else if (selectedOption == "orientador") {
                $("#cursos").show();
                $("#curso").hide();
                $("#semestre").hide();
                $("#matricula").show();
                $("#tipo_servidor").hide();
                $("#instituicaoVinculo").show();
            } else if (selectedOption == "servidor") {
                $("#cursos").hide();
                $("#curso").hide();
                $("#semestre").hide();
                $("#matricula").show();
                $("#tipo_servidor").show();
                $("#instituicaoVinculo").show();
            } else {
                $("#cursos").hide();
                $("#curso").hide();
                $("#semestre").hide();
                $("#matricula").hide();
                $("#tipo_servidor").hide();
                $("#instituicaoVinculo").hide();
            }
        });
    });
</script>



</script>

@endsection
