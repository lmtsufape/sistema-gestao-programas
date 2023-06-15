@extends("templates.app")
@section("body")
        <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:3.6em; ">

            @if (session('sucesso'))
                <div class="alert alert-success">
                    {{session('sucesso')}}
                </div>
            @endif
            <br>
            <br>

            <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
                <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
                    Editar Servidor</h1>
                    <hr>
                <form action="{{url("/servidores/$servidor->id")}}" method="POST">
                    @csrf
                    @method("PUT")
                    <label for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Nome:<strong style="color: red">*</strong></label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o nome" value="{{$servidor->user->name}}"
                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

                    <label for="nome_social" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Nome Social:</label>
                    <input type="text" id="nome_social" name="nome_social" value="{{$servidor->user->name_social}}"
                    style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

                    <label for="email" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">E-mail:<strong style="color: red">*</strong></label>
                    <input type="text" id="email" name="email" placeholder="Digite o e-mail" value="{{$servidor->user->email}}" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

                    <label for="senha" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Senha:<strong style="color: red">*</strong></label>
                    <input type="password" id="senha" name="senha" placeholder="Digite a senha" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>

                    <label for="cpf" for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">CPF:<strong style="color: red">*</strong></label>
                    <input  class="boxinfo cpf-autocomplete" name="cpf" id="cpf" type="text" placeholder="Digite o CPF" value="{{$servidor->cpf}}" style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br/><br>


                    <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%; padding-top: 15px;">
                        <input type="button" value="Voltar" href="{{url("/meu-perfil-servidor/")}}" onclick="window.location.href='{{url("/meu-perfil-servidor/")}}'"
                        style="background: #2D3875; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                        border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                        line-height: 29px; text-align: center; padding: 5px 15px;">

                        <input type="submit" value="Editar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                        display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                        font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                    </div>
                </form>
            </div>
        </div>
<script  src="{{ mix('js/app.js') }}">
        $('.cpf-autocomplete').inputmask('999.999.999-99');
</script>
@endsection
