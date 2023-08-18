@extends("templates.app")

@section("body")
    @canany(['admin', 'servidor'])
        <style>
            select[multiple] {
                overflow: hidden;
                background: #f5f5f5;
                width:100%;
                height:auto;
                padding: 0px 5px;
                margin:0;
                border-width: 2px;
                border-radius: 5px;
                -moz-appearance: menulist;
                -webkit-appearance: menulist;
                appearance: menulist;
            }
            /* select single */
            .required .chosen-single {
                background: #F5F5F5;
                border-radius: 5px;
                border: 1px #D3D3D3;
                padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
            }
            /* select multiple */
            .required .chosen-choices {
                background: #F5F5F5;
                border-radius: 5px;
                border: 1px #D3D3D3;
                padding: 0px 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
            }
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

            .radio-spacing {
                padding-right: 20px; /* Ajuste o valor conforme necessário */
            }



        </style>
        <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{session('sucesso')}}
                </div>
            @endif
            <br>

            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande"> Cadastrar Edital {{$programa->nome}}</h1>
                </div>

                <hr style="color:#5C1C26; background-color: #5C1C26">

                <form action="{{route('edital.store')}}" method="POST">
                    @csrf

                    <label class="titulopequeno" for="titulo_edital">Título<strong style="color: #8B5558">*</strong></label>
                    <input class="boxcadastrar" placeholder="Digite o título" type="text" name="titulo_edital" id="titulo_edital" value="{{ old('titulo_edital') }}" required><br><br>

                    <label class="titulopequeno" for="semestre">Semestre de Início<strong style="color: #8B5558">*</strong></label>
                    <input class="boxcadastrar" placeholder="Digite o semestre (Ex: 2023.2)" type="text" name="semestre" id="semestre" value="{{ old('semestre') }}" required><br><br>

                    <div class="container-divisao">
                    <div class="box-dividido">
                        <label class="titulopequeno" for="data_inicio" >Data de início<strong style="color: #8B5558">*</strong></label>
                        <input class="boxcadastrar" type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}">
                    </div>

                    <div class="box-dividido">
                        <label class="titulopequeno" for="data_fim" >Data de fim<strong style="color: #8B5558">*</strong></label>
                        <input class="boxcadastrar" type="date" name="data_fim" id="data_fim" value="{{ old('data_fim') }}">
                    </div>
                    </div>

                    <label class="titulopequeno" for="Descrição">Descrição:</label>
                    <textarea class="boxcadastrar" placeholder="Digite a descrição" name="descricao" id="descricao" cols="30" rows="3"> {{ old('descricao') }}</textarea><br><br>
                    <div style="display: flex; width: 100%; justify-content: space-between; gap: 2%">
                        <div style="width: 50%">
                            <label class="titulopequeno" for="bolsa">Possui bolsa? <strong style="color: #8B5558">*</strong></label>
                            <br>
                            <input type="radio" name="checkBolsa" value="sim" required>
                            <label class="textinho" for="checkBolsa_sim">Sim</label>
                            <br>
                            <input type="radio" name="checkBolsa" value="nao" required>
                            <label class="textinho" for="checkBolsa_nao">Não</label><br><br>

                            <div id="valor_bolsa" hidden>
                                <label class="titulopequeno" for="valor_bolsa">Valor da Bolsa<strong style="color: #8B5558">*</strong></label>
                                <input class="boxcadastrar" placeholder="Digite o valor da bolsa"
                                type="number" name="valor_bolsa" id="valor_bolsa" value="{{ old('valor_bolsa') }}"><br><br>
                            </div>

                        </div>
                        <div style="width: 50%">
                            <label class="titulopequeno" for="disciplina">Possui disciplina(s)? <strong style="color: #8B5558">*</strong></label>
                            <br>
                            <input type="radio" name="checkDisciplina" value="sim" required>
                            <label class="textinho" for="checkDisciplina_sim">Sim</label>
                            <br>
                            <input type="radio" name="checkDisciplina" value="nao" required>
                            <label class="textinho" for="checkDisciplina_nao">Não</label><br><br>


                            <div id="disciplinas" hidden>
                                <label class="titulo" for="disciplina">Disciplina(s)</label>
                                <div class="colunm">
                                    @foreach ($disciplinas as $disciplina)
                                    <div class="col-md-12" style="display: flex; justify-items:flex-start; gap:3%">
                                        <input type="checkbox" id="disciplina_{{ $disciplina->id }}" name="disciplinas[]" value="{{ $disciplina->id }}"> {{ $disciplina->nome . '/' . $disciplina->curso->nome}}<br>
                                    </div>
                                    @endforeach</div><br><br>
                            </div>
                        </div>
                        </div>
                    <br><br>

                    <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{ route('edital.index')}}" onclick="window.location.href='{{ route("edital.index")}}'" class="botaovoltar">
                    <input type="submit" value="Salvar" class="botaosalvar">
                    </div>
                </form>
            </div>
            <br><br>
        </div>

        <script>
            $(document).ready(function() {
                $("#tem_bolsa").change(function() {
                    var selectedOption = $(this).val();
                    if(selectedOption == 0){
                        $("#valor_bolsa").hide();
                    }else{
                        $("#valor_bolsa").show();
                    }
                });
            });

            $(document).ready(function() {
                $("input[name='checkBolsa']").change(function() {
                    if ($("input[name='checkBolsa']:checked").val() == "sim"){
                        $("#valor_bolsa").removeAttr("hidden");

                    } else {
                        $("#valor_bolsa").attr("hidden", true);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("input[name='checkDisciplina']").change(function() {
                    if ($("input[name='checkDisciplina']:checked").val() == "sim"){
                        $("#disciplinas").removeAttr("hidden");

                    } else {
                        $("#disciplinas").attr("hidden", true);
                    }
                });
            });
        </script>
        <script  src="{{ mix('js/app.js') }}">

            $('.semestre-autocomplete').inputmask('0000.0');

            $("#programa").chosen({
                placeholder_text_single: "Selecione um programa",
                // max_shown_results : 5,
                no_results_text: "Não possui programas."
            });

            // $("#disciplina").chosen({
            //     placeholder_text_single: {{$disciplina->id}},
            //     // max_shown_results : 5,
            //     no_results_text: "Não possui disciplinas."
            // });

            $("#orientadors").chosen({
                placeholder_text_multiple: "Selecione um orientador",
                // max_shown_results : 5,
                no_results_text: "Não possui orientadors."
            });

            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
        </script>
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url('/login')}}">Voltar</a>
  @endcan
@endsection
