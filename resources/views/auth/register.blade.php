@extends("templates.app")

@section("body")

<div class="container">
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
            <label for="name" class="titulo-cad">Nome<strong style="color: #8B5558">*</strong></label>
            <input class="boxinfo" type="text" id="name" name="name" required placeholder="Digite o nome">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="name_social" class="titulo-cad">Nome Social</label>
            <input class="boxinfo" type="text" id="name_social" name="name_social" placeholder="Digite o nome social">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cpf" class="titulo-cad">CPF<strong style="color: #8B5558">*</strong></label>
            <input class="boxinfo cpf-autocomplete" type="text"  id="cpf" name="cpf" required placeholder="Digite o CPF">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="email" class="titulo-cad">E-mail<strong style="color: #8B5558">*</strong></label>
            <input class="boxinfo" type="email" id="email" name="email" required placeholder="Digite o email">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="password" class="titulo-cad">Senha<strong style="color: #8B5558">*</strong></label>
            <input type="password"  class="boxinfo" id="password" name="password" required placeholder="Digite a senha">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="tipoUser" class="titulo-cad">Perfil<strong style="color: #8B5558">*</strong></label>
            <select aria-label="Default select example" class="boxinfo" name="tipoUser" id="tipoUser">
                <option value disabled selected hidden>Selecione o perfil</option>
                <option value="servidor">Técnico administrativo</option>
                <option value="orientador">Docente</option>
                <option value="aluno">Discente</option>
            </select>

            <div id="instituicaoVinculo" class="d-none">
                <label class="titulo-cad" for="instituicaoVinculo">Intituição de Vínculo<strong style="color: #8B5558">*</strong></label>
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

            <div id="curso" class="d-none">
                <label for="curso_id" class="titulo-cad">Curso</label>
                <select aria-label="Default select example" class="boxinfo" name="curso_id" id="curso_id">
                    <option selected hidden>Selecione o curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div id="cursos" class="d-none">
                <label class="titulo-cad">Curso(s) que Leciona</label>
                <div class="row">
                    @foreach ($cursos as $curso)
                    <div class="col-md-6" style="display: flex; justify-items:flex-start; gap:3%">
                        <input type="checkbox" name="cursos[]" value="{{$curso->id}}"> {{$curso->nome}}<br>
                    </div>
                    @endforeach
                </div>

            </div>


            <div id="matricula" class="d-none">
                <label class="titulo-cad" for="matricula">Matrícula<strong style="color: #8B5558">*</strong></label>
                <input class="boxinfo" type="text" id="matricula" name="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)">
            </div>


            <div id="semestre-div" class="d-none">
                <label class="titulo-cad" for="semestre_entrada">Semestre de entrada<strong style="color: #8B5558">*</strong></label>
                <input class="boxinfo" type="text"  id="semestre_entrada" name="semestre_entrada" placeholder="Digite o semestre (Exemplo: 2023.2)">
            </div>


            <div class="container-botoes pt-5">
                <a href="/">
                <input type="button" value="Voltar" class="botaovoltar"/>
                </a>

                <input type="submit" value="Cadastrar" class="botaosalvar"/>
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
                $("#curso, #semestre-div").removeClass("d-none");
                $("#cursos, #matricula, #tipo_servidor, #instituicaoVinculo").addClass("d-none");
            } else if (selectedOption == "orientador") {
                $("#cursos, #matricula, #instituicaoVinculo").removeClass("d-none");
                $("#curso, #semestre-div, #tipo_servidor").addClass("d-none");
            } else if (selectedOption == "servidor") {
                $("#matricula, #tipo_servidor, #instituicaoVinculo").removeClass("d-none");
                $("#cursos, #curso, #semestre-div").addClass("d-none");
            } else {
                $("#matricula, #tipo_servidor, #instituicaoVinculo, #cursos, #curso, #semestre-div").addClass("d-none");
            }
        });
    });
</script>



</script>

@endsection
