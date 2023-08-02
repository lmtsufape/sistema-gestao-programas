@extends("templates.app")

@section("body")


@canany(['admin', 'pro_reitor', 'gestor'])
    <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <br>
        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                <h1 class="titulogrande">Cadastrar Programa</h1>
            </div>

            <hr style="color:#5C1C26; background-color: #5C1C26">

            <form action="{{route('programas.store')}}" method="post">
                @csrf

                <label for="nome" class="titulopequeno" >Nome:<strong style="color: red">*</strong></label>
                <input type="text" name="nome" value="{{ old('nome') }}" id="nome" placeholder="Digite o nome do programa" class="boxcadastrar" required><br><br>

                <label for="descricao" class="titulopequeno">Descrição:<strong style="color: red">*</strong></label>
                <input type="text" name="descricao" value="{{ old('descricao') }}" id="descricao" placeholder="Digite a descrição do programa" class="boxcadastrar" required><br><br>

                <div style="display: flex; width: 100%; justify-content: space-between; gap: 2%">
                    <div style="width: 50%">
                    <label class="titulopequeno" for="data_inicio">Data de início:<strong style="color: red">*</strong></label>
                    <br>
                    <input class="boxcadastrar" type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}"><br><br>
                    </div>
                    <div style="width: 50%">
                    <label class="titulopequeno"  for="data_fim" >Data de fim:<strong style="color: red">*</strong></label>
                    <br>
                    <input class="boxcadastrar"  type="date" name="data_fim" id="data_fim" value="{{ old('data_fim') }}"><br><br>
                    </div>
                </div>

                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                    <input type="button" value="Voltar" href="{{url('/home/')}}" onclick="window.location.href='{{url('/home/')}}'" style="background: #2D3875;
                                box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                line-height: 29px; text-align: center; padding: 5px 15px;">
                    <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                        display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                        font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                </div>
            </form>
        </div>
        <br>
        <br>
    </div>

        <script>
            $("#servidors").chosen({
            placeholder_text_multiple: "Selecione um servidor",
            // max_shown_results : 5,
            no_results_text: "Não possui estudante."
        });
            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
        </script>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection
