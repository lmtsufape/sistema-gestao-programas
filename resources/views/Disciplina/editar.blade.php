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
                <h1 class="titulogrande">Editar Disciplina</h1>
            </div>

                <hr>
                <form action="{{url("disciplinas/$disciplina->id")}}" method="POST">
                    @csrf
                    @method("PUT")
                    <label for="nome" class="titulopequeno">Título:<strong style="color: red">*</strong></label>
                    <br>
                    <input class="boxcadastrar" type="text" id="nome" name="nome"  value="{{$disciplina->nome}}"  required placeholder="Digite o nome">
                    <div class="invalid-feedback">Por favor preencha esse campo</div>
                    <br><br>

                    <label for="inputCurso" class="titulopequeno" >Curso:<strong style="color: red">*</strong></label>
                    <br>
                    <select aria-label="Default select example" class="boxcadastrar" id="inputCurso" name="curso">
                        @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}" {{$disciplina->curso_id == $curso->id ? 'selected' : ''}} >{{$curso->nome}}</option>
                        @endforeach
                    </select>
                    <br><br>

                    <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{url("/disciplinas/")}}" onclick="window.location.href='{{url("/disciplinas/")}}'"
                        class="botaovoltar">
                        <input type="submit" value="Salvar" class="botaosalvar">
                    </div>
                </form>
            </div>
        </div>
        
    @elsecan
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
    @endcan
@endsection
