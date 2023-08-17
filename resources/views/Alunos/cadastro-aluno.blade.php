@extends("templates.app")

@section("body")

@canany(['admin', 'servidor'])
<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

    @if (session('sucesso'))
    <div class="alert alert-sucess" style="width: 100%;">
        {{session('sucesso')}}
    </div>
    @endif
    <br>
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Cadastrar Estudante</h1>
        </div>

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{route('alunos.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image" class="titulopequeno">Imagem do Perfil:</label>
            <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 150px; height: 150px; border-radius: 50%;"/>
            <input type="file" id="image" name="image" class="form-control-file">

            <label for="inputName" class="titulopequeno">Nome<strong style="color: #8B5558;">*</strong></label>
            <input class="boxcadastrar" type="text" id="inputName" name="nome" required placeholder="Digite o nome" value="{{ old('nome') }}">
            <div class="invalid-feedback">Por favor preencha esse campo</div>

            <label for="inputNomeSocial" class="titulopequeno">Nome Social</label>
            <input class="boxcadastrar" type="text" id="inputNomeSocial" name="name_social" placeholder="Digite o nome" value="{{ old('name_social') }}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="inputCpf" class="titulopequeno">CPF<strong style="color: #8B5558;">*</strong></label>
            <input class="boxinfo cpf-autocomplete" type="text"  id="inputCpf" name="cpf" required placeholder="Digite o CPF" value="{{ old('cpf') }}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br><br>


            <label for="inputSemestre" class="titulopequeno">Semestre de Entrada<strong style="color: #8B5558;">*</strong></label>
            <input class="boxinfo semestre-autocomplete" type="text"  id="inputSemestre" name="semestre_entrada" required placeholder="Digite o semestre" value="{{ old('semestre_entrada') }}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <br><br>


            <label for="inputCurso" class="titulopequeno">Curso<strong style="color: #8B5558;">*</strong></label>
            <select aria-label="Default select example" class="boxcadastrar" id="inputCurso" name="curso">
                <option value disabled selected hidden>Selecione o curso</option>
                @foreach ($cursos as $curso)
                <option value="{{$curso->id}}" {{ old('curso') == $curso->id ? 'selected' : '' }} >{{$curso->nome}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="inputEmail4" class="titulopequeno">E-mail<strong style="color: #8B5558;">*</strong></label>
            <input class="boxcadastrar" type="email" id="inputEmail4" name="email" required placeholder="Digite o email" value="{{ old('email') }}">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="inputPassword4" class="titulopequeno">Senha<strong style="color: #8B5558;">*</strong></label>
            <input type="password"  class="boxcadastrar" id="inputPassword4" name="senha" required placeholder="Digite a senha">
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <div class="botoessalvarvoltar">
                <input type="button" value="Voltar" href="{{url('/edital/')}}" onclick="window.location.href='{{url('/edital/')}}'" class="botaovoltar">
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
    <br>
    <br>
</div>
@elsecan
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url('/home')}}">Voltar</a>
@endcan

<script type="text/javascript" src="{{ mix('js/app.js') }}">

    $('.cpf-autocomplete').inputmask('999.999.999-99');


    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

@endsection
