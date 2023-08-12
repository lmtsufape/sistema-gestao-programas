@extends("templates.app")


@section("body")
    @include("auth.modal_criar_aluno")

    {{-- <x-jet-validation-errors class="mb-4" />
    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif --}}
    @if (session('sucesso'))
    <div class="alert alert-sucess">
        <p style="color: green">{{session('sucesso')}}</p>
    </div>
    @endif
    <br>

    <div class="container">

        <div class="login row">

            <div class="col div-paragraph">
                <h2 class="title-login">O que é?</h2>
                <p class="paragraph">
                O sistema tem como intuito auxiliar no gerenciamento dos programas acadêmicos, como bolsas, monitorias e estágios.
                Desenvolvido para simplificar e automatizar, a plataforma proporciona controle e eficiência nas
                funções acadêmicas e garante que cada parte envolvida tenha visibilidade e participação ativa em todo o processo.
                Promove, desse modo, uma comunicação clara e otimizada.
                </p>
            </div>

            <div class="col form-card">
                <div class="form-content">
                    <h2 class="title-form">Entrar</h2>
                    <hr class="divisor-login">
                </div>
                <br>
                <form class="form-content" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-body">
                        <div class="field" >
                            <label for="email" class="titulo-login">E-mail</label>
                            <input id="email" placeholder="Digite seu e-mail" name="email" class="input-login form-control input-modal-create" type="text"  >
                        </div>
                        <br>

                        <div class="field" >
                            <label for="password" class="titulo-login">Senha</label>
                            <input id="password" placeholder="Digite sua senha" name="password" class="input-login form-control input-modal-create" type="password"  >
                        </div>

                        <div class="forgot ">
                            <a class="forgot-link" href="{{ route('password.request')}}">Esqueceu sua senha?</a>
                        </div>


                        <div class="form-buttons">
                            <!-- :<div> -->
                            <button type="submit" class="red-button">Entrar</button>
                            <!-- </div> -->
                            <!-- <div style="margin-left: auto; margin-right: 0;"> -->
                            <a href="{{ route('register')}}" class="register-button"> Cadastre-se</a>
                            <!-- </div> -->

                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#modal_create" style="text-decoration: none; cursor: point;">Cadastre-se</a> -->
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>
@endsection

