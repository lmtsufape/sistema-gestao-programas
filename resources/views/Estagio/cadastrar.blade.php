@extends('templates.app')

@section('body')
    @canany(['admin', 'servidor', 'gestor'])
        <style>
            select[multiple] {
                overflow: hidden;
                background: #f5f5f5;
                width: 100%;
                height: auto;
                padding: 0px 5px;
                margin: 0;
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

            .boxinfo {
                background: #F5F5F5;
                border-radius: 6px;
                border: 1px #D3D3D3;
                width: 100%;
                padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
            }

            .boxchild {
                background: #FFFFFF;
                box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
                border-radius: 20px;
                padding: 34px;
                width: 65%
            }
        </style>

        <div class="container"
            style="display: flex; justify-content: center; align-items: center; margin-top: 2.5em; margin-bottom:10px; ">
            @if (session('sucesso'))
                <div class="alert alert-success">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>

            <div class="boxchild">
                <div class="row">
                    <h1
                        style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
                        Cadastrar Estagio</h1>
                </div>

                <hr style="color:#2D3875;">

                <form action="{{ route('estagio.store') }}"method="post">
                    @csrf

@canany(['admin', 'servidor', 'gestor'])
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
                    Cadastrar Estágio</h1>
                </div>

                <hr>

                <form action="{{route('estagio.store')}}" method="POST">
                    @csrf

                    <div id="checkStatus">
                        <label class="titulo radio-spacing" for="status">Status: <strong style="color: red">*</strong></label>
                        <input type="radio" name="checkStatus" value="true" required checked>
                        <label class="radio-spacing" for="checkStatus_ativo">Ativo</label>
                        <input type="radio" name="checkStatus" value="false" required>
                        <label class="radio-spacing" for="checkStatus_inativo">Inativo</label><br><br>
                    </div>


                    <label class="titulo" for="Descrição">Descrição:<strong style="color: red">*</strong></label>
                    <textarea class="boxinfo" placeholder="Digite a descrição" name="descricao" id="descricao" cols="30" rows="3"> {{ old('descricao') }}</textarea><br><br>

                    <label class="titulo" for="data_inicio" class="titulo">Data de início:<strong style="color: red">*</strong></label>
                    <input class="boxinfo" type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}"><br><br>

                    <label class="titulo" for="data_fim" >Data de fim:<strong style="color: red">*</strong></label>
                    <input class="boxinfo"  type="date" name="data_fim" id="data_fim" value="{{ old('data_fim') }}"><br><br>

                    <label class="titulo" for="data_solicitacao" >Data da solicitação:<strong style="color: red">*</strong></label>
                    <input class="boxinfo"  type="date" name="data_solicitacao" id="data_solicitacao" value="{{ old('data_solicitacao') }}"><br><br>

                    <div id="checkTipo">
                        <label class="titulo radio-spacing" for="tipo">Tipo: <strong style="color: red">*</strong></label>
                        <input type="radio" name="checkTipo" value="sim" required>
                        <label class="radio-spacing" for="checkTipo_obrigatorio">Obrigatório</label>
                        <input type="radio" name="checkTipo" value="nao" required>
                        <label class="radio-spacing" for="checkTipo_nao_obrigatorio">Não Obrigatório</label><br><br>
                    </div>

                    <label class="titulo" for="">CPF do estudante: <strong style="color: red">*</strong></label>
                    <input type="text" id="cpf_aluno" class="boxinfo cpf-autocomplete" name="cpf_aluno"
                        value="{{ old('cpf_aluno') }}" placeholder="Digite o CPF do aluno" required data-url="{{ url('/cpfs') }}">
                    <br>
                    <br>

                    <label class="titulo" for="orientador">Orientador:<strong style="color: red">*</strong></label>
                    <select aria-label="Default select example" class="boxinfo" name="orientador" id="orientador" >
                        <option  value disabled selected hidden> Selecione o Orientador</option>
                            @foreach ($orientadors as $orientador)
                                <option value="{{$orientador->id}}" {{ old('orientador') == $orientador->id ? 'selected' : '' }}>{{$orientador->user->name}}</option>
                            @endforeach
                    </select><br><br>
                     

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
            <br><br>
        </div>

        <script  src="{{ mix('js/app.js') }}">

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

                    <label for="nome" class="titulo">Descrição:<strong style="color: red">*</strong></label>
                    <input class="boxinfo" type="text" name="descricao" id="descricao"
                        placeholder="Digite a descrição do estagio" required><br><br>
                    <label for="nome" class="titulo">Data inicial:<strong style="color: red">*</strong></label>
                    <input class="boxinfo" type="date" name="data_inicio" id="data_inicio"
                        placeholder="Digite a data de inicio do estagio" required><br><br>
                    <label for="nome" class="titulo">Data final:<strong style="color: red">*</strong></label>
                    <input class="boxinfo" type="date" name="data_fim" id="data_fim"
                        placeholder="Digite a data final do estagio" required><br><br>
                    <label for="nome" class="titulo">Data de solicitação:<strong style="color: red">*</strong></label>
                    <input class="boxinfo" type="date" name="data_solicitacao" id="data_solicitacao"
                        placeholder="Digite a data de solicitação do estagio" required><br><br>
                    <select aria-label="Default select example" class="boxinfo" id="tipo" name="tipo_estagio">
                        <option value disabled selected hidden>Selecione o tipo</option>
                        <option value="eo">Estágio obrigatório (EO)</option>
                        <option value="eno">Estágio não obrigatório (ENO)</option>
                    </select>

                    <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                        <input type="button" value="Voltar" href="{{ url('/home/') }}"
                            onclick="window.location.href='{{ url('/home/') }}'"
                            style="background: #2D3875;
                                    box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                    border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                    line-height: 29px; text-align: center; padding: 5px 15px;">
                        <input type="submit" value="Salvar"
                            style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                        display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                        font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                    </div>


                </form>

            </div>
        </div>



        <script>
            $("#disciplinas").chosen({
                placeholder_text_multiple: "Selecione uma disciplina",
                // max_shown_results : 5,
                no_results_text: "Não possui disciplinas."
            });

            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
        </script>
    @endsection
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
@endcan
