@extends("templates.app")

@section('body')

@canany(['admin', 'servidor', 'gestor', 'aluno'])

        <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{session('sucesso')}}
                </div>
            @endif
            <br>

            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Cadastrar Estágio</h1>
                </div>

                <hr style="color:#5C1C26; background-color: #5C1C26">

                <form action="{{route('estagio.store')}}" method="POST">
                    @csrf

                    <div id="checkStatus">
                        <label class="titulopequeno" for="status">Status: <strong style="color: red">*</strong></label>
                        <br>
                        <input type="radio" name="checkStatus" value="true" required checked>
                        <label class="textinho" for="checkStatus_ativo">Ativo</label>
                        <br>
                        <input type="radio" name="checkStatus" value="false" required>
                        <label class="textinho" for="checkStatus_inativo">Inativo</label><br><br>
                    </div>


                    <label class="titulopequeno" for="Descrição">Descrição:<strong style="color: red">*</strong></label>
                    <textarea class="boxcadastrar" placeholder="Digite a descrição" name="descricao" id="descricao" cols="30" rows="3"> {{ old('descricao') }}</textarea><br><br>

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

                    <div id="checkTipo">
                        <label class="titulopequeno" for="tipo">Tipo: <strong style="color: red">*</strong></label>
                        <br>
                        <input type="radio" name="checkTipo" value="eo" required>
                        <label class="textinho" for="checkTipo_obrigatorio">Obrigatório</label>
                        <br>
                        <input type="radio" name="checkTipo" value="eno" required>
                        <label class="textinho" for="checkTipo_nao_obrigatorio">Não Obrigatório</label><br><br>
                    </div>

                    @if(auth()->user()->typage_type == "App\Models\Aluno")
                        <label class="titulopequeno" for="">CPF do estudante: <strong style="color: red">*</strong></label>
                        <input type="text" id="cpf_aluno" class="boxcadastrar cpf-autocomplete" name="cpf_aluno"
                            value="{{ auth()->user()->cpf }}" placeholder="Digite o CPF do aluno" required data-url="{{ url('/cpfs') }}" readonly>
                    @else
                        <label class="titulopequeno" for="">CPF do estudante: <strong style="color: red">*</strong></label>
                        <input type="text" id="cpf_aluno" class="boxcadastrar cpf-autocomplete" name="cpf_aluno"
                            value="{{ old('cpf_aluno') }}" placeholder="Digite o CPF do aluno" required data-url="{{ url('/cpfs') }}">
                    @endif
                    <br>
                    <br>

                    <label class="titulopequeno" for="orientador">Orientador:<strong style="color: red">*</strong></label>
                    <select aria-label="Default select example" class="boxcadastrar" name="orientador" id="orientador" >
                        <option  value disabled selected hidden> Selecione o Orientador</option>
                            @foreach ($orientadors as $orientador)
                                <option value="{{$orientador->id}}" {{ old('orientador') == $orientador->id ? 'selected' : '' }}>{{$orientador->user->name}}</option>
                            @endforeach
                    </select><br><br>


                    <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{url('/edital/')}}" onclick="window.location.href='{{url('/edital/')}}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
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

@endsection
