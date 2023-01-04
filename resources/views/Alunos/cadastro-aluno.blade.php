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
    <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%">
        <div class="row">
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
                Cadastrar Aluno</h1>
        </div>

        <hr>

        <form action="{{route("alunos.store")}}" method="POST">
            @csrf
            <label for="inputName" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;" class="form-label ">Nome:</label>
            <input type="text" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" class="form-control" id="inputName" name="nome" required>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>


            <label for="inputCpf" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;" class="form-label ">CPF:</label>
            <input type="text" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" class="form-control" id="inputCpf" name="cpf" required>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>


            <label for="inputSemestre" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;" class="form-label ">Semestre de Entrada:</label>
            <input type="text" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" class="form-control" id="inputSemestre" name="semestre_entrada" required>
            <div class="invalid-feedback"> Por favor preencha esse campo</div> <br>


            <label for="inputCurso" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;" class="form-label ">Curso:</label>
            <select style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" class="form-control" id="inputCurso" name="curso">
                <option value=""></option>
                @foreach ($cursos as $curso)
                <option value="{{$curso->id}}">{{$curso->nome}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <label for="inputEmail4" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;" class="form-label ">Email:</label>
            <input type="email" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" id="inputEmail4" name="email" required>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="inputPassword4" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;" class="form-label ">Senha:</label>
            <input type="password" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);" class="form-control" id="inputPassword4" name="senha" required>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br>

            <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                <input type="button" value="Voltar" href="{{url("/alunos/")}}" onclick="window.location.href='{{url("/alunos/")}}'" style="background: #2D3875; 
                            box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                            border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                            line-height: 29px; text-align: center; padding: 5px 15px;">

                <input type="submit" value="Cadastrar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                            display: inline-block;
                            border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal; font-weight: 400; font-size: 24px;
                            line-height: 29px; text-align: center; padding: 5px 15px;">
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
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
