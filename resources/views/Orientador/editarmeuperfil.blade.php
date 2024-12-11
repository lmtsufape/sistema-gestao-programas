@extends("templates.app")

@section("body")

    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:10em; flex-direction:column;">

        @if (session('sucesso'))
            <div class="alert alert-success">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Editar Perfil</h1>
            </div>
                <form action="{{  route('meu-perfil-orientador.atualizar', ['id'=> $orientador->id])   }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div style="display: flex; flex-direction: row; gap:15px; margin-bottom:20px">
                @if($orientador->user->image)
                <img src="/images/fotos-perfil/{{ $orientador->user->image }}" alt="Foto Perfil" style="width: 8.77rem; border-radius: 50%; margin-top: 2rem; margin-bottom: 1rem;"/>
                @else
                <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 8.77rem; border-radius: 50%; margin-top: 2rem; margin-bottom: 1rem;"/>
                @endif
                    <div style="align-self:flex-end">
                        <input type="file" id="image" name="image" class="form-control boxinfo">
                    </div>
                </div>

                <label for="nome_social" class="titulopequeno">Nome Social:</label>
                <input class="boxcadastrar" type="text" id="name_social" name="name_social" placeholder="Digite o nome social" value="{{$orientador->user->name_social}}">
                <br>

                <label for="nome" class="titulopequeno">Nome Completo<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" id="name" name="name" required placeholder="Digite o nome" value="{{$orientador->user->name}}">
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <br>

                <label for="email" for="nome" class="titulopequeno">E-mail<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" id="email" name="email" required placeholder="Digite o e-mail" value="{{$orientador->user->email}}">
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <br>

                <label for="cpf" for="nome" class="titulopequeno">CPF<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar cpf-autocomplete" name="cpf" id="cpf" required type="text" placeholder="Digite o CPF" value="{{$orientador->cpf}}" >
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <br>

                <label for="matricula" class="titulopequeno">Matrícula<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" name="matricula" id="matricula" required placeholder="Digite a matrícula (Exemplo: SIAPE)" value="{{$orientador->matricula}}">
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <br>

                <label for="instituicaoVinculo" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" name="instituicaoVinculo" id="instituicaoVinculo" placeholder="Digite a instituição vinculada ao docente" value="{{ $orientador->instituicaoVinculo }}" required>
                <br>

                <label for="curso" class="titulopequeno">Curso(s)<strong style="color: #8B5558">*</strong></label>
                @foreach ($cursos as $curso)
                    <div>
                        <input type="checkbox" id="curso_{{ $curso->id }}" name="cursos[]" value="{{ $curso->id }}" @if(in_array($curso->id, $cursosSelecionados)) checked @endif>
                        <label class= "titulopequeno" for="curso_{{ $curso->id }}">{{ $curso->nome }}</label>
                    </div>
                @endforeach
                <br>

                <label for="senha" for="nome" class="titulopequeno">Senha<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="password" id="senha" name="senha" required placeholder="Digite a senha">
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <br>
                <br>

                <div class="botoessalvarvoltar" style="justify-content:start">
                    <input type="button" class="botaovoltar" value="Voltar" href="{{url("/meu-perfil-orientador/")}}" onclick="window.location.href='{{url("/meu-perfil-orientador/")}}'">
                    <input type="submit" class="botaosalvar" value="Editar">
                </div>
            </form>
        </div>
        <br>
        <br>
    </div>
    <style>
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
    </style>
<script  src="{{ mix('js/app.js') }}">
    $('.cpf-autocomplete').inputmask('999.999.999-99');
</script>
@endsection
