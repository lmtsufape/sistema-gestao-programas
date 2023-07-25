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
</style>

    <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <br>

        <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">Editar Professor</h1>
            <hr>
            <form action="{{  route('meu-perfil-orientador.atualizar', ['id'=> $orientador->id])   }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                @if($orientador->user->image)
                <img src="/images/fotos-perfil/{{ $orientador->user->image }}" alt="Foto Perfil" style="width: 150px; height: 150px; border-radius: 50%;"/>
                @else
                <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 150px; height: 150px; border-radius: 50%;"/>
                @endif
                <input type="file" id="image" name="image" class="form-control-file">

                <label for="nome" class="titulo">Nome:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" id="name" name="name" placeholder="Digite o nome" value="{{$orientador->user->name}}"
                ><br/><br>

                <label for="nome_social" class="titulo">Nome Social:</label>
                <input class="boxinfo" type="text" id="name_social" name="name_social" placeholder="Digite o nome social" value="{{$orientador->user->name_social}}"
                ><br/><br>

                <label for="email" for="nome" class="titulo">E-mail:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" id="email" name="email" placeholder="Digite o e-mail" value="{{$orientador->user->email}}"><br/><br>

                <label for="cpf" for="nome" class="titulo">CPF:<strong style="color: red">*</strong></label>
                <input class="boxinfo cpf-autocomplete" name="cpf" id="cpf" type="text" placeholder="Digite o CPF" value="{{$orientador->cpf}}" ><br/><br>

                <label for="matricula" class="titulo">Matrícula:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" name="matricula" id="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)" value="{{$orientador->matricula}}"><br><br>

                <label for="instituicaoVinculo" class="titulo">Instituição:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" name="instituicaoVinculo" id="instituicaoVinculo" placeholder="Digite a instituição vinculada ao professor" value="{{ $orientador->instituicaoVinculo }}" required><br><br>

                <label for="curso" class="mb-2" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Curso(s):<strong style="color: red">*</strong></label>
                @foreach ($cursos as $curso)
                    <div>
                        <input type="checkbox" id="curso_{{ $curso->id }}" name="cursos[]" value="{{ $curso->id }}" @if(in_array($curso->id, $cursosSelecionados)) checked @endif>
                        <label for="curso_{{ $curso->id }}">{{ $curso->nome }}</label>
                    </div>
                @endforeach
                <br><br>

                <label for="senha" for="nome" class="titulo">Senha:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="password" id="senha" name="senha" placeholder="Digite a senha"><br/><br>

                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                    <input type="button" class="btn btn-secondary" value="Voltar" href="{{url("/meu-perfil-orientador/")}}" onclick="window.location.href='{{url("/meu-perfil-orientador/")}}'"
                    style=" display: inline-block;
                    border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                    line-height: 29px; text-align: center; padding: 5px 15px;">

                    <input type="submit" class="btn btn-primary" value="Editar" style="display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                    font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
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
