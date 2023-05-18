@extends("templates.app")

@section("body")
    <style>
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
            <div class="alert alert-sucess" style="width: 100%;">
                {{session('sucesso')}}
            </div>
            @endif
            <br>
            <div class="boxchild">
                <div class="row">
                <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
                        Cadastrar Disciplina</h1>
                </div>

                <hr>

                <form action="{{route("disciplinas.store")}}" method="post">
                    @csrf
                    <label for="inputName" class="titulo" >Disciplinas: </label>
                    <input class="boxinfo" type="text" id="inputName" name="nome" required placeholder="Digite o nome">
                    <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

                    <label for="inputCurso" class="titulo" >Curso: </label>
                    <select aria-label="Default select example" class="boxinfo" id="inputCurso" name="curso">
                        <option disabled selected>Selecione o curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->nome}}</option>
                            @endforeach
                    </select>
                    <br>
                    <br>
                    <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                        <input type="button" value="Voltar" href="{{url("/disciplinas/")}}" onclick="window.location.href='{{url("/disciplinas/")}}'" style="background: #2D3875;
                                    box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                    border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                    line-height: 29px; text-align: center; padding: 5px 15px;">

                        <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
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
    @elsecan
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
    @endcan
@endsection