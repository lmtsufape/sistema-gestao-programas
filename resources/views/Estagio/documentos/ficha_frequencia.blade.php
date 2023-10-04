@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Ficha de Frequência</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.ficha-frequencia.store', ['id' => $estagio->id]) }}" method="post">
            @csrf

            <!-- Campos com base no nome -->
            <label for="campus" class="titulopequeno">Campus<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="campus" id="campus" value="{{ $dados['campus'] ?? '' }}"
                placeholder="Digite o nome do campus que o estagiário estuda"
                required><br><br>

            <label for="semestre_letivo" class="titulopequeno">Semestre Letivo<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="semestre_letivo" id="semestre_letivo"
                placeholder="Digite o semestre letivo que o estagiário está"
                value="{{ $dados['semestre_letivo'] ?? '' }}" required><br><br>

            <label for="nome_estagiario" class="titulopequeno">Estagiário<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome_estagiario" id="nome_estagiario"
                placeholder="Digite o nome do estagiário"
                value="{{ $dados['nome_estagiario'] ?? '' }}" required><br><br>

            <label for="periodo" class="titulopequeno">Período<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo" value="{{ $dados['periodo'] ?? '' }}"
                placeholder="Digite o período que o estagiário está"
                required><br><br>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" value="{{ $dados['curso'] ?? '' }}"
                placeholder="Digite o curso do estagiário"
                required><br><br>

            <label for="componente_curricular" class="titulopequeno">Componente Curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="componente_curricular" id="componente_curricular"
                placeholder="Digite o componente curricular"
                value="{{ $dados['componente_curricular'] ?? '' }}" required><br><br>

            <label for="prof_componente_curricular" class="titulopequeno">Professor(a) do Componente Curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="prof_componente_curricular" id="prof_componente_curricular"
                placeholder="Digite o nome do professor do componente curricular"
                value="{{ $dados['prof_componente_curricular'] ?? '' }}" required><br><br>

            <label for="prof_orientador" class="titulopequeno">Professor(a) Orientador(a)<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="prof_orientador" id="prof_orientador"
                placeholder="Digite o nome do professor orientador do estagiário"
                value="{{ $dados['prof_orientador'] ?? '' }}" required><br><br>

            <label for="local_estagio" class="titulopequeno">Local do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="local_estagio" id="local_estagio"
                placeholder="Digite o nome da instituição onde será feito o estágio"
                value="{{ $dados['local_estagio'] ?? '' }}" required><br><br>

            <label for="supervisor_estagio" class="titulopequeno">Supervisor(a) do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisor_estagio" id="supervisor_estagio"
                placeholder="Digite o nome do supervisor do estágio"
                value="{{ $dados['supervisor_estagio'] ?? '' }}" required><br><br>
<!-- 
            <label for="data1" class="titulopequeno">Data</label>
            <br>
            <input class="boxcadastrar" type="text" name="data1" id="data1" value="{{ $dados['data1'] ?? '' }}"
                required><br><br>

            <label for="atividade1" class="titulopequeno">Atividade</label>
            <br>
            <input class="boxcadastrar" type="text" name="atividade1" id="atividade1"
                value="{{ $dados['atividade1'] ?? '' }}" required><br><br>

            <label for="ch1" class="titulopequeno">CH</label>
            <br>
            <input class="boxcadastrar" type="text" name="ch1" id="ch1" value="{{ $dados['ch1'] ?? '' }}"
                required><br><br>

            <label for="ch_total" class="titulopequeno">Carga Horária Total</label>
            <br>
            <input class="boxcadastrar" type="text" name="ch_total" id="ch_total"
                value="{{ $dados['ch_total'] ?? '' }}" required><br><br> -->

            <br><br>
            <div class="botoessalvarvoltar">
                <input type="button" value="Voltar" onclick="window.location.href='{{ url('/home/') }}'"
                    class="botaovoltar">
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
@endsection
