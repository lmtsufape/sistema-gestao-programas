@extends('templates.app')

@section('body')
    @canany(['admin', 'servidor', 'gestor'])

        <div class="container-fluid"
            style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>

            <div class="fundocadastrar">
                <div class="row" style="align-content: left;">
                    <h1 class="titulogrande">Editar estágio</h1>
                </div>

                <hr style="color:#5C1C26; background-color: #5C1C26">

                <form action="{{ route('estagio.update', ['id' => $estagio->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($aluno)
                        <input type="hidden" name="checkStatus" value="1">
                    @else
                        <div id="checkStatus">
                            <label class="titulopequeno" for="status">Status: <strong
                                    style="color: #8B5558">*</strong></label>
                            <br>
                            <input type="radio" name="checkStatus" value=1 required
                                @if ($estagio->status == 1) checked @endif>
                            <label class="textinho" for="checkStatus_ativo">Ativo</label>
                            <br>
                            <input type="radio" name="checkStatus" value=0 required
                                @if ($estagio->status == 0) checked @endif>
                            <label class="textinho" for="checkStatus_inativo">Inativo</label><br><br>
                        </div>
                    @endif

                    <label class="titulopequeno" for="Descrição">Descrição<strong style="color: #8B5558">*</strong></label>
                    <textarea class="boxcadastrar" placeholder="Digite a descrição" name="descricao" id="descricao" cols="30"
                        rows="3"> {{ $estagio->descricao }}</textarea><br><br>

                    <div style="display: flex; width: 100%; justify-content: space-between; gap: 2%">
                        <div style="width: 50%">
                            <label class="titulopequeno" for="data_inicio">Data de início<strong
                                    style="color: #8B5558">*</strong></label>
                            <br>
                            <input class="boxcadastrar" type="date" name="data_inicio" id="data_inicio"
                                value="{{ $estagio->data_inicio->format('Y-m-d') }}"><br><br>
                        </div>
                        <div style="width: 50%">
                            <label class="titulopequeno" for="data_fim">Data de fim<strong
                                    style="color: #8B5558">*</strong></label>
                            <br>
                            <input class="boxcadastrar" type="date" name="data_fim" id="data_fim"
                                value="{{ $estagio->data_fim->format('Y-m-d') }}"><br><br>
                        </div>
                    </div>

                    <div id="checkTipo">
                        <label class="titulopequeno" for="tipo">Tipo: <strong style="color: #8B5558">*</strong></label>
                        <br>
                        <input type="radio" name="checkTipo" value="eo" required
                            @if ($estagio->tipo == 'eo') checked @endif>
                        <label class="textinho" for="checkTipo_obrigatorio">Obrigatório</label>
                        <br>
                        <input type="radio" name="checkTipo" value="eno" required
                            @if ($estagio->tipo == 'eno') checked @endif>
                        <label class="textinho" for="checkTipo_nao_obrigatorio">Não obrigatório</label><br><br>
                    </div>

                    @if ($aluno)
                        <label class="titulopequeno" for="">CPF do estudante: <strong
                                style="color: #8B5558">*</strong></label>
                        <input type="text" id="cpf" class="boxcadastrar cpf-autocomplete" name="cpf_aluno"
                            value="{{ $aluno->cpf }}" placeholder="Digite o CPF do aluno" required
                            data-url="{{ url('/cpfs') }}" readonly style="background: #eee; ">
                    @else
                        <label class="titulopequeno" for="">CPF do estudante: <strong
                                style="color: #8B5558">*</strong></label>
                        <input type="text" id="cpf_aluno" class="boxcadastrar cpf-autocomplete" name="cpf_aluno"
                            value="{{ $estagio->aluno->cpf }}" placeholder="Digite o CPF do aluno" required
                            data-url="{{ url('/cpfs') }}">
                    @endif
                    <br>
                    <br>

                    <label class="titulopequeno" for="orientador">Orientador<strong style="color: #8B5558">*</strong></label>
                    <select aria-label="Default select example" class="boxcadastrar" name="orientador" id="orientador">
                        <option value disabled selected hidden> Selecione o orientador</option>
                        @foreach ($orientadors as $orientador)
                            <option value="{{ $orientador->id }}"
                                {{ $estagio->orientador_id == $orientador->id ? 'selected' : '' }}>
                                {{ $orientador->user->name }}</option>
                        @endforeach
                    </select><br><br>

                    <label class="titulopequeno" for="supervisor">Supervisor<strong style="color: #8B5558">*</strong></label>
                    <select aria-label="Default select example" class="boxcadastrar" name="supervisor" id="supervisor">
                        <option value disabled selected hidden> Selecione o supervisor</option>
                        @foreach ($supervisors as $supervisor)
                            <option value="{{ $supervisor->id }}"
                                {{ $estagio->supervisor_id == $supervisor->id ? 'selected' : '' }}>{{ $supervisor->nome }}
                            </option>
                        @endforeach
                    </select><br><br>


                    @if ($aluno)
                        <label class="titulopequeno" for="curso">Curso<strong style="color: #8B5558">*</strong></label>
                        <select aria-label="Default select example" class="boxcadastrar" name="curso" id="curso"
                            style="background: #eee; pointer-events: none; touch-action: none;">
                            <option value disabled selected hidden> Selecione o curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ $aluno->curso_id == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nome }}</option>
                            @endforeach
                        </select><br><br>
                    @else
                        <label class="titulopequeno" for="curso">Curso<strong style="color: #8B5558">*</strong></label>
                        <select aria-label="Default select example" class="boxcadastrar" name="curso" id="curso">
                            <option value disabled selected hidden> Selecione o curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ $estagio->curso_id == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nome }}</option>
                            @endforeach
                        </select><br><br>
                    @endif

                    <div id="disciplinas" @if ($estagio->tipo == 'eno') hidden @endif>
                        <label class="titulopequeno" for="curso">Disciplina:<strong
                                style="color: #8B5558">*</strong></label>
                        <select aria-label="Default select example" class="boxcadastrar" name="disciplina" id="disciplina">
                            <option value disabled selected hidden> Selecione a disciplina</option>
                            @foreach ($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}"
                                    {{ $estagio->disciplina_id == $disciplina->id ? 'selected' : '' }}>{{ $disciplina->nome }}
                                    / {{ $disciplina->curso->nome }}</option>
                            @endforeach. S
                        </select><br><br>
                    </div>

                    <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{ url('/home/') }}"
                            onclick="window.location.href='{{ url('/home/') }}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
                    </div>
                </form>
            </div>
            <br><br>
        </div>

        <script>
            const selectDisciplina = document.getElementById('disciplina');

            $(document).ready(function() {
                $("input[name='checkTipo']").change(function() {
                    if ($("input[name='checkTipo']:checked").val() == "eo") {
                        $("#disciplinas").removeAttr("hidden");
                        selectDisciplina.required = true;
                    } else {
                        $("#disciplinas").attr("hidden", true);
                        selectDisciplina.required = false;

                    }
                });


            });
        </script>
        <script src="{{ mix('js/app.js') }}">
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
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
    @endcan
@endsection
