@extends("templates.app")

@section("body")
    @canany(['admin', 'servidor'])
        <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

            @if (session('sucesso'))
            <div class="alert alert-sucess" style="width: 100%;">
                {{session('sucesso')}}
            </div>
            @endif
            <br>
            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Cadastrar Disciplina</h1>
                </div>

                <hr>

                <form action="{{route("disciplinas.store")}}" method="post">
                    @csrf
                    <label for="disciplina" class="titulopequeno">Disciplina<strong style="color: #8B5558">*</strong></label>
                    <br>
                    <input class="boxcadastrar" type="text" id="inputName" name="nome" required placeholder="Digite o nome">
                    <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

                    <label for="inputCurso" class="titulopequeno" >Curso<strong style="color: #8B5558">*</strong></label>
                    <br>
                    <select aria-label="Default select example" class="boxcadastrar" id="inputCurso" name="curso">
                        <option value disabled selected hidden>Selecione o curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->nome}}</option>
                            @endforeach
                    </select>
                    <br><br>
                    <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{url('/disciplinas/')}}" onclick="window.location.href='{{url('/disciplinas/')}}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
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
