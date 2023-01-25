@extends("templates.app")


@section("body")
    @include("auth.modal_criar_aluno")

    {{-- <x-jet-validation-errors class="mb-4" />
    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif --}}
    <div class="container" style="padding-top: 5%">

        <div class="row" style="justify-content: center; align-items: center">

            <div class="col">
                <p style="font-weight: 700; font-size:30px; text-align: start">O que é?</p>
                <p style="font-weight: 400; font-size:20px; text-align: justify; padding-right: 5%; padding-top: 3%">
                O sistema permite o gerenciamento de programas acadêmicos (bolsas, monitorias, estágios, etc..),
                de forma a facilitar e automatizar o processo. Com esse sistema todos os envolvidos no processo
                poderão ter mais controle da sua função, tornando o processo mais eficaz.
                </p>
            </div>

            <div class="col form-card">
                <h2 style="font-style: normal; font-weight: 700; font-size: 30px; line-height: 59px;
                 color: #131833; text-align: center">Entrar</h2>
                <hr style="margin-right: 60px; margin-left: 60px;" >
                <form class="form-content" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3" style="text-align: left">
                        <label for="email" style="font-weight: 400; font-size: 20px;
                         line-height: 35px; color: #000000;">Email:</label>
                        <input id="email" name="email" style="background: #F5F5F5; border-radius: 10px;
                         height: 40px;" class="form-control input-modal-create" type="text" placeholder="Digite seu email" >
                    </div>

                    <div class="mb-3" style="text-align: left">
                        <label for="password" style="font-weight: 400; font-size: 20px;
                         line-height: 35px; color: #000000;">Senha:</label>
                        <input id="password" name="password" style="background: #F5F5F5; border-radius: 10px;
                         height: 40px;" class="form-control input-modal-create" type="password" placeholder="Digite sua senha" >
                    </div>

                    <div style="display: flex;">
                        <div>
                        <input type="checkbox" id="lembredemim" name="lembredemim" value="Lembredemim">
                        <label for="lembredemim"> Lembre-se de mim </label>
                        </div>
                        <div style="margin-left: auto; margin-right: 0;">
                        <a href="">Esqueceu sua senha?</a>
                        </div>

                    </div>

                    <div style="display:flex">
                        <!-- :<div> -->
                        <button type="submit" class="btn btn-primary submit-button"
                        style="background: #34A853; height: 40px; width: 200px; border-radius: 15px;
                         margin-left: 0; margin-top: 30px; width: 30%; border: none;">Entrar</button>
                        <!-- </div> -->
                        <!-- <div style="margin-left: auto; margin-right: 0;"> -->
                        <a href="{{url("/cadastrar-se/")}}" style="background: #2D3875; height: 40px; color:#F5F5F5;
                        width: 200px; border-radius: 15px; margin-left: auto; margin-right: 0; margin-top: 30px;
                        width: 30%; border: none; text-decoration: none; padding-top: 8px"> Cadastre-se</a>
                        <!-- </div> -->

                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#modal_create" style="text-decoration: none; cursor: point;">Cadastre-se</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
