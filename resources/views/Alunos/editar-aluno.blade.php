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

@canany(['admin', 'servidor'])
<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
    @if (session('sucesso'))
        <div class="alert alert-success" style="width: 100%;">
            {{session('sucesso')}}
        </div>
    @endif
    <br>
    <div class="boxchild">
        <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
            Editar Aluno</h1>
        <hr style="color: #2D3875;">
        <form action="{{  route('alunos.update', ['id' => $aluno->id])  }}" method="POST">
            @csrf
            @method("PUT")
            <label for="nome" class="titulo">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{$aluno->user->name}}"
            class="boxinfo"><br/><br>


            <label for="nome_social" class="titulo">Nome Social:</label>
            <input type="text" id="nome_social" name="nome_social" value=""
            class="boxinfo"><br/><br>

            <label for="email" for="nome" class="titulo">E-mail:</label>
            <input type="text" id="email" name="email" value="{{$aluno->user->email}}" class="boxinfo"><br/><br>

            <label for="senha" for="nome" class="titulo">Senha:</label>
            <input type="password" id="senha" name="senha" class="boxinfo"><br/><br>

            <label for="cpf" for="nome" class="titulo">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="{{$aluno->cpf}}" class="boxinfo cpf-autocomplete"><br/><br>

            <label for="curso" for="nome" class="titulo">Curso:</label>
            <select name="curso" id="curso" class="boxinfo"> name="curso" id="curso">
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" {{$aluno->curso_id == $curso->id ? "selected" : ""}}>{{$curso->nome}}</option>
                @endforeach
            </select><br><br>

            <label for="semestre_entrada" for="nome" class="titulo">Semestre de entrada:</label>
            <input type="text" id="semestre_entrada" name="semestre_entrada" value="{{$aluno->semestre_entrada}}" class="boxinfo"><br/><br>

            <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                <input type="button" value="Voltar" href="{{url('/alunos/')}}" onclick="window.location.href='{{url('/alunos/')}}'"
                style="background: #2D3875; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                line-height: 29px; text-align: center; padding: 5px 15px;">

                <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
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

<script  src="{{ mix('js/app.js') }}">


    $('.cpf-autocomplete').inputmask('999.999.999-99');

</script>
@endsection
