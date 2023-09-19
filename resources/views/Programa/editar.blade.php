@extends("templates.app")

@section("body")


@canany(['admin', 'pro_reitor', 'gestor'])
    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">

        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{session('sucesso')}}
            </div>
        @endif
        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                <h1 class="titulogrande">Editar Programa</h1>
            </div>
            <hr class="divisor">

            <form action="{{url("/programas/$programa->id")}}" method="post">
                @csrf
                @method("PUT")
                <label for="nome" class="titulopequeno" >Nome<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" name="nome" id="nome" value="{{$programa->nome}}">

                <label for="descricao" class="titulopequeno">Descrição<strong style="color: #8B5558">*</strong></label>
                <input class="boxcadastrar" type="text" name="descricao" id="descricao" value="{{$programa->descricao}}">

                <div style="display: flex; width: 100%; justify-content: space-between; gap: 2%">
                    <div style="width: 50%">
                    <label class="titulopequeno" for="data_inicio">Data de início<strong style="color: #8B5558">*</strong></label>
                    <br>
                    <input class="boxcadastrar" type="date" name="data_inicio" id="data_inicio" value="{{$programa->data_inicio}}">
                    </div>
                    <div style="width: 50%">
                    <label class="titulopequeno"  for="data_fim" >Data de fim<strong style="color: #8B5558">*</strong></label>
                    <br>
                    <input class="boxcadastrar"  type="date" name="data_fim" id="data_fim" value="{{$programa->data_fim}}">
                    </div>
                </div>


                <label class="titulopequeno" for="servidor">Servidor<strong style="color: #8B5558">*</strong></label>
                @foreach ($servidors as $servidor)
                    <div>
                        <input type="radio" id="servidor_{{ $servidor->id }}" name="servidors[]" value="{{ $servidor->id }}" @if(in_array($servidor->id, $servidoresSelecionados)) checked @endif>
                        <label class="textinho" for="servidor_{{ $servidor->id }}">{{ $servidor->user->name }}</label>
                    </div>
                @endforeach

                <br><br>
                   <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{url('/programas/')}}" onclick="window.location.href='{{url('/programas/')}}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
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
        no_results_text: "Não possui alunos."
    });
        $('div.chosen-container-single').addClass('required');
        $('div.chosen-container-multi').addClass('required');
    </script>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan

@endsection
