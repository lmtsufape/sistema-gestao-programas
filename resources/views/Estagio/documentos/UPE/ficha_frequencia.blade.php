@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Ficha de frequência</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UPE.ficha-frequencia.store', ['id' => $estagio->id]) }}" method="post">
            @csrf

            <!-- Campos com base no nome -->
            <label for="campus" class="titulopequeno">Campus<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="campus" id="campus" value="{{ $dados['campus'] ?? '' }}"
                placeholder="Digite o nome do campus que o estagiário estuda" required><br><br>

            <label for="semestre_letivo" class="titulopequeno">Semestre letivo<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="semestre_letivo" id="semestre_letivo"
                placeholder="Digite o semestre letivo que o estagiário está" value="{{ $dados['semestre_letivo'] ?? '' }}"
                required><br><br>

            <label for="nome_estagiario" class="titulopequeno">Estagiário<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome_estagiario" id="nome_estagiario"
                placeholder="Digite o nome do estagiário" value="{{ $aluno->user->name }}" readonly required><br><br>

            <label for="periodo" class="titulopequeno">Período<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo" value="{{ $dados['periodo'] ?? '' }}"
                placeholder="Digite o período que o estagiário está" required><br><br>

            <label for="curso" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" value="{{ $aluno->curso->nome }}"
                placeholder="Digite o curso do estagiário" readonly required><br><br>

            <label for="componente_curricular" class="titulopequeno">Componente curricular<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="componente_curricular" id="componente_curricular"
                placeholder="Digite o componente curricular" value="{{ $dados['componente_curricular'] ?? '' }}"
                required><br><br>

            <label for="prof_componente_curricular" class="titulopequeno">Professor(a) do componente curricular<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="prof_componente_curricular" id="prof_componente_curricular"
                placeholder="Digite o nome do professor do componente curricular"
                value="{{ $dados['prof_componente_curricular'] ?? '' }}" required><br><br>

            <label for="prof_orientador" class="titulopequeno">Professor(a) orientador(a)<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="prof_orientador" id="prof_orientador"
                value="{{ $orientador->user->name }}" placeholder="Digite o nome do professor orientador do estagiário"
                readonly required><br><br>

            <label for="local_estagio" class="titulopequeno">Local do estágio<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="local_estagio" id="local_estagio"
                placeholder="Digite o nome da instituição onde será feito o estágio"
                value="{{ $dados['local_estagio'] ?? '' }}" required><br><br>

            <label for="supervisor_estagio" class="titulopequeno">Supervisor(a) do estágio<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisor_estagio" id="supervisor_estagio"
                placeholder="Digite o nome do supervisor do estágio" value="{{ $dados['supervisor_estagio'] ?? '' }}"
                required><br><br>


            <p>Este formulário facilita o preenchimento do seu documento para maior comodidade. Pedimos que baixe o
                documento já preenchido e, ao final do estágio, por favor, envie-o integralmente. Agradecemos pela sua
                colaboração.</p>
            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>

        </form>
    </div>
@endsection
