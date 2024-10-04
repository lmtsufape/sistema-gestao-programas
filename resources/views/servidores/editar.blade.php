@extends("templates.app")
@section("body")
    @can('editar servidor')

        <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1rem; margin-bottom: 3.6rem; ">

            @if (session('sucesso'))
                <div class="alert alert-success">
                    {{session('sucesso')}}
                </div>
            @endif
            <br>
            <br>

            <div class="fundocadastrar">
                <h1 class="titulogrande">
                    Editar Servidor</h1>
                    <hr class="divisor">
                <form action="{{route('servidores.update', ['id' => $servidor->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div style="display:flex; flex-direction: column;">
                        <label for="perfil" class="titulopequeno">Foto do Perfil</label>
                        @if($servidor->user->image)
                        <img src="/images/fotos-perfil/{{ $servidor->user->image }}" alt="Foto Perfil" class="images"/>
                        @else
                        <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" class="images"/>
                        @endif
                        <input type="file" id="image" name="image" class="form-control boxcadastrar">
                    </div>
                    <label for="nome" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o nome" value="{{$servidor->user->name}}"
                    class="boxcadastrar"><br/>

                    <label for="nome_social" for="nome" class="titulopequeno">Nome Social</label>
                    <input type="text" id="nome_social" placeholder="Digite o nome social" name="nome_social" value="{{$servidor->user->name_social}}"
                    class="boxcadastrar"><br/>

                    <label for="email" for="nome" class="titulopequeno">E-mail<strong style="color: #8B5558">*</strong></label>
                    <input type="text" id="email" name="email" placeholder="Digite o e-mail" value="{{$servidor->user->email}}" class="boxcadastrar"><br/>

                    <label for="senha" for="nome" class="titulopequeno">Senha<strong style="color: #8B5558">*</strong></label>
                    <input type="password" id="senha" name="senha" placeholder="Digite a senha" class="boxcadastrar"><br/>

                    <label for="cpf" for="nome" class="titulopequeno">CPF<strong style="color: #8B5558">*</strong></label>
                    <input  class="boxcadastrar cpf-autocomplete" name="cpf" id="cpf" type="text" placeholder="Digite o CPF" value="{{$servidor->cpf}}" ><br/>

                    <label for="tipo_servidor_editar" class="titulopequeno">Tipo do servidor<strong style="color: #8B5558">*</strong></label>
                    <select name="tipo_servidor" id="tipo_servidor"
                    class="boxcadastrar" aria-label="Default select example">

                        @if ($servidor->tipo_servidor == 'administrador')
                            <option value="0" selected>Administrador</option>
                            <option value="1">Pró-Reitor</option>
                            <option value="3">Diretor</option>
                            <option value="2">Técnico Administrativo</option>
                        @elseif ($servidor->tipo_servidor == 'pro-reitor')
                            <option value="0">Administrador</option>
                            <option value="1" selected>Pró-Reitor</option>
                            <option value="3">Diretor</option>
                            <option value="2">Técnico Administrativo</option>
                        @elseif ($servidor->tipo_servidor == 'diretor')
                            <option value="0">Administrador</option>
                            <option value="1">Pró-Reitor</option>
                            <option value="3" selected>Diretor</option>
                            <option value="2">Técnico Administrativo</option>
                        @else
                            <option value="0">Administrador</option>
                            <option value="1">Pró-Reitor</option>
                            <option value="3">Diretor</option>
                            <option value="2" selected>Técnico Administrativo</option>
                        @endif

                    </select><br><br>

                    <div class="container-botoes">
                        <input type="button" value="Voltar" href="{{url("/servidores/")}}" onclick="window.location.href='{{url("/servidores/")}}'"
                        class="botaovoltar">

                        <input type="submit" value="Editar" class="botaosalvar">
                    </div>
                </form>
            </div>
        </div>
        <script  src="{{ mix('js/app.js') }}">
            $('.cpf-autocomplete').inputmask('999.999.999-99');
        </script>
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
    @endcan
@endsection
