@extends("templates.app")

@section("body")

@canany(['admin', 'servidor'])
    <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                <h1 class="titulogrande">Editar Professor</h1>
            </div>
            <hr class="divisor">
            <form action="{{  route('orientadors.update', ['id'=> $orientador->id])   }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div style="display: flex; flex-direction: column;">
                    <label for="perfil" class="titulopequeno">Foto de Perfil:</label>
                    @if($orientador->user->image)
                    <img src="/images/fotos-perfil/{{ $orientador->user->image }}" alt="Foto Perfil" class="images"/>
                    @else

                    <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" class="images"/>
                    @endif

                    <input type="file" id="image" name="image" class="form-control boxcadastrar"> 
                </div>
                

                <label for="nome" class="titulopequeno">Nome:<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" id="name" name="name" placeholder="Digite o nome" value="{{$orientador->user->name}}">

                <label for="nome_social" class="titulopequeno">Nome Social:</label>
                <input class="boxcadastrar" type="text" id="name_social" name="name_social" placeholder="Digite o nome social" value="{{$orientador->user->name_social}}">

                <label for="email" for="nome" class="titulopequeno">E-mail:<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" id="email" name="email" placeholder="Digite o e-mail" value="{{$orientador->user->email}}">

                <label for="cpf" for="nome" class="titulopequeno">CPF:<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar cpf-autocomplete" name="cpf" id="cpf" type="text" placeholder="Digite o CPF" value="{{$orientador->cpf}}" >

                <label for="matricula" class="titulopequeno">Matrícula:<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" name="matricula" id="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)" value="{{$orientador->matricula}}">

                <label for="instituicaoVinculo" class="titulopequeno">Instituição:<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" name="instituicaoVinculo" id="instituicaoVinculo" placeholder="Digite a instituição vinculada ao professor" value="{{ $orientador->instituicaoVinculo }}" required>

                <label for="curso" class="titulopequeno">Curso(s):<strong style="color: #8B5558">*</strong></label>
                <div class="row">
                    @foreach ($cursos as $curso)
                        <div class="col-md-6" style="display: flex; justify-items:flex-start; gap:3%">
                            <input type="checkbox" class="titulopequeno" id="curso_{{ $curso->id }}" name="cursos[]" value="{{ $curso->id }}" @if(in_array($curso->id, $cursosSelecionados)) checked @endif> 
                            <span class="checkbox-text">{{ $curso->nome }}</span>
                        </div>
                    @endforeach
                </div><br>
                <label for="senha" for="nome" class="titulopequeno">Senha:<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="password" id="senha" name="senha" placeholder="Digite a senha"><br/><br>

                <div class="botoessalvarvoltar">
                    <input type="button" class="botaovoltar" value="Voltar" href="{{route('orientadors.index')}}" onclick="window.location.href='{{route('orientadors.index')}}'">
                    <input type="submit" class="botaosalvar" value="Editar">
                </div>
            </form>
        </div>
        <br>
        <br>
    </div>
    
    </style>
    <script  src="{{ mix('js/app.js') }}">
        $('.cpf-autocomplete').inputmask('999.999.999-99');
    </script>
@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
@endcan

@endsection
