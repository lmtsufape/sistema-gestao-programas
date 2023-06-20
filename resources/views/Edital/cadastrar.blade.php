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
        <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{session('sucesso')}}
                </div>
            @endif
            <br>

            <div class="boxchild">
                <div class="row" >
                    <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875; " >
                    Cadastrar Edital</h1>
                </div>

                <hr>

                <form action="{{route('edital.store')}}" method="POST">
                    @csrf

                    <label class="titulo" for="titulo_edital">Título:<strong style="color: red">*</strong></label>
                    <input class="boxinfo" placeholder="Digite o título" type="text" name="titulo_edital" id="titulo_edital" value="{{ old('titulo_edital') }}" required><br><br>

                    <label class="titulo" for="semestre">Semestre de Início:<strong style="color: red">*</strong></label>
                    <input class="boxinfo semestre-autocomplete" placeholder="Digite o semestre (Ex: 2023.2)" type="text" name="semestre" id="semestre" value="{{ old('semestre') }}" required><br><br>

                    <label class="titulo" for="Descrição">Descrição:</label>
                    <textarea class="boxinfo" placeholder="Digite a descrição" name="descricao" id="descricao" cols="30" rows="3"> {{ old('descricao') }}</textarea><br><br>

                    <label class="titulo" for="data_inicio" class="titulo">Data de início:<strong style="color: red">*</strong></label>
                    <input class="boxinfo" type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}"><br><br>

                    <label class="titulo" for="data_fim" >Data de fim:<strong style="color: red">*</strong></label>
                    <input class="boxinfo"  type="date" name="data_fim" id="data_fim" value="{{ old('data_fim') }}"><br><br>

                    <label class="titulo" for="tem_bolsa">Tem bolsa:</label>
                    <select aria-label="Defacult select example" class="boxinfo" name="tem_bolsa" id="tem_bolsa">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>

                    <div id="valor_bolsa" style="display: none">
                        <label class="titulo" for="valor_bolsa">Valor da Bolsa:<strong style="color: red">*</strong></label>
                        <input class="boxinfo" placeholder="Digite o valor da bolsa"
                        type="number" name="valor_bolsa" id="valor_bolsa" value="{{ old('valor_bolsa') }}"><br><br>
                    </div>

                    <label class="titulo" for="programa">Programa:<strong style="color: red">*</strong></label>
                    <select aria-label="Default select example" class="boxinfo" name="programa" id="programa" >
                        <option></option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}" {{ old('programa') == $programa->id ? 'selected' : '' }}>{{$programa->nome}}</option>
                            @endforeach
                    </select><br><br>

                    <div id="checkDisciplina">
                        <label class="titulo radio-spacing" for="disciplina">Possui disciplina(s)?: <strong style="color: red">*</strong></label>
                        <input type="radio" name="checkDisciplina" value="sim" required>
                        <label class="radio-spacing" for="checkDisciplina_sim">Sim</label>
                        <input type="radio" name="checkDisciplina" value="nao" required>
                        <label class="radio-spacing" for="checkDisciplina_nao">Não</label>
                    </div><br><br>

                    <div id="disciplinas" hidden>
                        <label class="titulo" for="disciplina">Disciplina(s):</label>
                        @foreach ($disciplinas as $disciplina)
                        <div>
                            <input type="checkbox" id="disciplina_{{ $disciplina->id }}" name="disciplinas[]" value="{{ $disciplina->id }}">
                            <label for="disciplina_{{ $disciplina->id }}">{{ $disciplina->nome . '/' . $disciplina->curso->nome}}</label>
                        </div>
                        @endforeach<br><br>
                    </div>

                    <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                        <input type="button" value="Voltar" href="{{ route('edital.index')}}" onclick="window.location.href='{{ route("edital.index")}}'" style="background: #2D3875;
                        box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                        border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                        line-height: 29px; text-align: center; padding: 5px 15px;">
                        <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                        display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                        font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
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
