@extends("templates.app")

@section("body")

    @canany(['admin', 'servidor'])
        <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:10px; ">

            @if (session('sucesso'))
            <div class="alert alert-sucess" style="width: 100%;">
                {{session('sucesso')}}
            </div>
            @endif
            <br>
            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Cadastrar Curso</h1>
                </div>

                <hr style="color:#5C1C26; background-color: #5C1C26">

                <form action="{{route("disciplinas.store")}}" method="post">
                    @csrf
                    <label for="disciplina" class="titulopequeno">Disciplina:<strong style="color: red">*</strong></label>
                    <br>
                    <input class="boxcadastrar" type="text" id="inputName" name="nome" required placeholder="Digite o nome">
                    <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

                    <input type="hidden" name="curso" value="{{$curso->id}}">
                    <div style="display: flex; gap:5%">
                        {{--  <input type="button" value="Voltar" href="{{url('/home/')}}" onclick="window.location.href='{{url('/home/')}}'" style="background: #2D3875;
                                        box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                        border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                        line-height: 29px; text-align: center; padding: 5px 15px;">  --}}
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
    @else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
    @endcan
@endsection
