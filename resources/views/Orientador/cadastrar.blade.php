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
    .vinculo {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .form-check{
        margin-right: 35px;
    }
    .radios{
        margin:5px;
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
            <div class="row">
                <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
                    Cadastrar Professor</h1>
            </div>

            <hr>

            <form action="{{route('orientadors.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="image" class="titulo">Imagem do Perfil:</label>
                <img src="/images/sem-foto-perfil.png" alt="Foto Perfil" style="width: 150px; height: 150px; border-radius: 50%;"/>
                <input type="file" id="image" name="image" class="form-control-file">

                <label for="inputName" class="titulo">Nome:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" id="inputName" name="name" required placeholder="Digite o nome" value="{{ old('name') }}">
                <div class="invalid-feedback">Por favor preencha esse campo</div><br><br>

                <label for="inputNomeSocial" class="titulo">Nome Social:</label>
                <input class="boxinfo" type="text" id="inputNomeSocial" name="name_social" placeholder="Digite o nome social" value="{{ old('name_social') }}">
                <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

                <label for="email" class="titulo">E-mail:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" name="email" id="email" placeholder="Digite o e-mail" value="{{ old('email') }}" required><br><br>

                <label for="cpf" class="titulo">CPF:<strong style="color: red">*</strong></label>
                <input class="boxinfo cpf-autocomplete" type="text" name="cpf" id="cpf" placeholder="Digite o CPF" value="{{ old('cpf') }}" required><br><br>

                <label for="matricula" class="titulo">Matrícula:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="text" name="matricula" id="matricula" placeholder="Digite a matrícula (Exemplo: SIAPE)" value="{{ old('matricula') }}" required><br><br>

                <label class="titulo" for="instituicaoVinculo">Intituição:<strong style="color: red">*</strong></label>
                <div class="vinculo">
                                        
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UFAPE" name="instituicaoVinculo" required>
                        <label class="form-check-label" for="instituicaoVinculo">Universidade Federal do Agreste de Pernambuco</label>
                    </div>
                    
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="instituicaoVinculo" value="UPE" name="instituicaoVinculo" required>
                        <label class="form-check-label" for="instituicaoVinculo">Universidade de Pernambuco</label>
                    </div>
                </div> 
                <br>

                <label for="curso" class="mb-2" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Curso(s) que Leciona:<strong style="color: red">*</strong></label>
                <div class="row">
                    @foreach ($cursos as $curso)
                    <div class="col-md-6" style="display: flex; justify-items:flex-start; gap:3%">
                        <input type="checkbox" name="cursos[]" value="{{$curso->id}}"> {{$curso->nome}}<br>
                    </div>
                    @endforeach
                </div>
                <br><br>

                <label for="senha" class="titulo">Senha:<strong style="color: red">*</strong></label>
                <input class="boxinfo" type="password" name="senha" id="senha" placeholder="Digite a senha" required><br><br>

                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                    <input type="button" value="Voltar" href="{{route('orientadors.index')}}" onclick="window.location.href='{{route('orientadors.index')}}'"
                    style="background: #2D3875; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                    border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                    line-height: 29px; text-align: center; padding: 5px 15px;">

                    <input type="submit" value="Cadastrar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                    display: inline-block;
                    border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal; font-weight: 400; font-size: 24px;
                    line-height: 29px; text-align: center; padding: 5px 15px;">
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
