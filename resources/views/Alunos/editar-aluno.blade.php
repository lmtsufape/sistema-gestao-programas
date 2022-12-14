@extends("templates.app")

@section("body")


<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('sucesso'))
        <div class="alert alert-danger">
            {{session('sucesso')}}
        </div>
    @endif
    <br>
    <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
        <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
            Editar Aluno</h1>
            <hr>
        <form action="{{url("/alunos/$aluno->id")}}" method="POST">
            @csrf
            @method("PUT")
            <label for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{$aluno->user->name}}" 
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="email" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">E-mail:</label>
            <input type="text" id="email" name="email" value="{{$aluno->user->email}}" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="senha" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Senha:</label>
            <input type="password" id="senha" name="senha" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="cpf" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="{{$aluno->cpf}}" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <label for="curso" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Curso:</label>
            <select name="curso" id="curso" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);">
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" {{$aluno->id_curso == $curso->id ? "selected" : ""}}>{{$curso->nome}}</option>
                @endforeach
            </select><br><br>

            <label for="semestre_entrada" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Semestre de entrada:</label>
            <input type="text" id="semestre_entrada" name="semestre_entrada" value="{{$aluno->semestre_entrada}}" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

            <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                <input type="button" value="Voltar" href="{{url("/alunos/")}}" onclick="window.location.href='{{url("/alunos/")}}'"
                style="background: #2D3875; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                line-height: 29px; text-align: center; padding: 5px 15px;">

                <input type="submit" value="Editar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
            </div>
        </form>
    </div>
</div>

@endsection