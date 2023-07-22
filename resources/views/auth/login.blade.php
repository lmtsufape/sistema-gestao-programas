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
                O sistema permite o gerenciamento de programas acadêmicos (bolsas, monitorias, estágios, etc..),
                de forma a facilitar e automatizar o processo. Com esse sistema todos os envolvidos no processo
                poderão ter mais controle da sua função, tornando o processo mais eficaz.
                </p>
            </div>

            <div class="col form-card">
                <div class="form-content">
                    <h2 class="title-form">Entrar</h2>
                    <hr class="divisor">
                </div>
                <br>
                <form class="form-content" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-body">
                        <div class="field" >
                            <label for="email" class="label-login">E-mail:</label>
                            <input id="email" placeholder="Digite seu e-mail" name="email" class="input-login form-control input-modal-create" type="text"  >
                        </div>

                        <div class="field" >
                            <label for="password" class="label-login">Senha:</label>
                            <input id="password" placeholder="Digite sua senha" name="password" class="input-login form-control input-modal-create" type="password"  >
                        </div>

                        <div class="forgot">
                            <a class="forgot-link" href="{{ route('password.request')}}">Esqueceu sua senha?</a>
                        </div>
                        
                        <br>

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

<style>
    .div-paragraph{
        display: inline-flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        color: #590B10;
        font-style: normal;
        margin-right: 5%;
    }
    .container{
        padding-top: 5%;
    }
    .login{
        justify-content: center; 
        align-items: center
    }
    .paragraph{
        font-size: 20px;
        font-weight: 400;
        text-align: justify;
    }

    .title-login{
        font-weight: 700;
        font-size: 24px;
        text-align: start;
    }

    .form-card{
        display: flex;
        width: 40% !important; 
        padding: 40px 30px;
        flex-direction: column;
        justify-content: center;
        gap: 5px;
        border-radius: 10px;
        border: 1px solid rgba(245, 234, 236, 1);
        box-shadow: 5px 3px 11px 0px rgba(0, 0, 0, 0.25);
    }

    .title-form{
        color:#590B10;
        font-size: 24px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        text-align: start;
    }

    .field{
        display: flex;
        width: 100%;
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .label-login{
        color: #972E3F;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    .input-login{
        border-radius: 5px;
        border: 2px solid rgba(230, 230, 230, 1);
        
    }

    .form-control{
        box-shadow:none !important;
    }
    .form-header{
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-left: 20px;
    }
    .form-body{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }

    .form-buttons{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        gap: 20px;
    }

    .forgot{
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        width: 100%;
        color: #972E3F;
    }

    .forgot-link{
        color: #972E3F;
    }
    .divisor{
        background: #bbbdbf;
    }

    .red-button{
        background-color: #972E3F;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 14px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        padding: 10px;
        text-align: center;
        width: 100%;
        transition: 0.3s;
    }

    .register-button{
        border-radius: 5px;
        border: 1px solid rgba(240, 240, 240, 1);
        background-color: #F9F9F9;
        color: #2B2B2B;
        font-size: 14px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        width:100%;
        box-shadow: none !important;
    }

    .register-button:hover{
        background-color: #bbbdbf;
        color: #2B2B2B;
        transition: 0.3s;
    }

    .red-button:hover{
        background-color: #A1141D;
        transition: 0.3s;
    }
</style>
