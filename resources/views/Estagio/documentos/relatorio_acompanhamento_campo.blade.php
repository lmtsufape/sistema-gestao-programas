@extends('templates.app')

@section('body')
    <div class="container-fluid"
        style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
        <div class="fundocadastrar">
            <div class="row" style="align-content: left;">
                <h1 class="titulogrande">Relatório de Acompanhamento do Campo do Estágio</h1>
            </div>
            @if (Session::has('pdf_generated_success'))
                <div class="alert alert-success">
                    {{ Session::get('pdf_generated_success') }}
                </div>
            @endif

            <hr style="color:#5C1C26; background-color: #5C1C26">

            <form
                action="{{ route('estagio.documentos.relatorio-acompanhamento-campo.store', ['id' => $estagio->id]) }}"method="post">
                @csrf


                <label for="nome" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="curso" id="curso"
                    value="{{ $dados['curso'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Semestre Letivo<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="semestre" id="semestre"
                    value="{{ $dados['semestre'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <label for="nome" class="titulopequeno">Professor Orientador<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="orientador" id="orientador"
                    value="{{ $orientador->user->name }}" readonly required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>


                <label for="nome" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="instituicao" id="instituicao"
                    value="{{ $dados['instituicao'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="natureza" class="titulopequeno">Natureza<strong style="color: #8B5558">*</strong></label><br>
                <select name="natureza" id="natureza" class="boxcadastrar">
                    <option value="publica"
                        {{ isset($dados['natureza']) && $dados['natureza'] === 'publica' ? 'selected' : '' }}>Pública
                    </option>
                    <option value="privada"
                        {{ isset($dados['natureza']) && $dados['natureza'] === 'privada' ? 'selected' : '' }}>Privada
                    </option>
                </select>
                <br><br>


                <label for="nome" class="titulopequeno">Endereço<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="endereco" id="endereco"
                    value="{{ $dados['endereco'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Nº<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="num" id="num"
                    value="{{ $dados['num'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Complemento<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="complemento" id="complemento"
                    value="{{ $dados['complemento'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Fone<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="fone1" id="fone1"
                    value="{{ $dados['fone1'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="cep" id="cep"
                    value="{{ $dados['cep'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="bairro" id="bairro"
                    value="{{ $dados['bairro'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="cidade" id="cidade"
                    value="{{ $dados['cidade'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Estado<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="estado" id="estado"
                    value="{{ $dados['estado'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Representante<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="representante" id="representante"
                    value="{{ $dados['representante'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Cargo do Representante<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="cargo_representante" id="cargo_representante"
                    value="{{ $dados['cargo_representante'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Supervisor de Estágio<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="supervisor" id="supervisor"
                    value="{{ $dados['supervisor'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Cargo/Função do Supervisor de Estágio<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="cargo_supervisor" id="cargo_supervisor"
                    value="{{ $dados['cargo_supervisor'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Formação do Supervisor de Estágio<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="formacao_supervisor" id="formacao_supervisor"
                    value="{{ $dados['formacao_supervisor'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Fone do Supervisor de Estágio<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="fone2" id="fone2"
                    value="{{ $dados['fone2'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">E-mail do Supervisor de Estágio<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="email_supervisor" id="email_supervisor"
                    value="{{ $dados['email_supervisor'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="educacao" class="titulopequeno">Tipo da Educação<strong
                        style="color: #8B5558">*</strong></label>
                <br>
                <select name="educacao" id="educacao" class="boxcadastrar">
                    <option value="escolar"
                        {{ isset($dados['educacao']) && $dados['educacao'] == 'escolar' ? 'selected' : '' }}>Educação
                        escolar</option>
                    <option value="nao_escolar"
                        {{ isset($dados['educacao']) && $dados['educacao'] == 'nao_escolar' ? 'selected' : '' }}>Educação
                        não-escolar</option>
                </select>
                <br><br>

                <label for="nome" class="titulopequeno">Modalidade<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="modalidade" id="modalidade"
                    value="{{ $dados['modalidade'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="etapa" class="titulopequeno">Etapa<strong style="color: #8B5558">*</strong></label>
                <br>
                <select name="etapa" id="etapa" class="boxcadastrar">
                    <option value="infantil"
                        {{ isset($dados['etapa']) && $dados['etapa'] == 'infantil' ? 'selected' : '' }}>Educação infantil
                    </option>
                    <option value="fundamental"
                        {{ isset($dados['etapa']) && $dados['etapa'] == 'fundamental' ? 'selected' : '' }}>Ensino
                        Fundamental</option>
                    <option value="medio" {{ isset($dados['etapa']) && $dados['etapa'] == 'medio' ? 'selected' : '' }}>
                        Ensino Médio</option>
                </select>
                <br><br>

                <label for="nome" class="titulopequeno">Profissional (is) entrevistado (s) <strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="entrevistados" id="entrevistados"
                    value="{{ $dados['entrevistados'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Informações Complementares <strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="complementares" id="complementares"
                    value="{{ $dados['complementares'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Estagiário<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="estag1" id="estag1"
                    value="{{ $dados['estag1'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Turma/Ano<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="turma1" id="turma1"
                    value="{{ $dados['turma1'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                <label for="nome" class="titulopequeno">Turno<strong style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="turno1" id="turno1"
                    value="{{ $dados['turno1'] ?? '' }}"required><br><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                {{-- Campos de opções abaixo --}}

                <label for="nome" class="titulopequeno">
                    O prédio possui estrutura e mobiliário adequados para a realização de suas atividades.
                    <strong style="color: #8B5558">*</strong></label>
                <br>
                <select name="opc1" id="opc1" class="boxcadastrar">
                    <option value="sim" {{ isset($dados['opc1']) && $dados['opc1'] == 'sim' ? 'selected' : '' }}>Sim
                    </option>
                    <option value="parcialmente"
                        {{ isset($dados['opc1']) && $dados['opc1'] == 'parcialmente' ? 'selected' : '' }}>Parcialmente
                    </option>
                    <option value="nao" {{ isset($dados['opc1']) && $dados['opc1'] == 'nao' ? 'selected' : '' }}>Não
                    </option>
                </select>
                <br><br>

                <label for="nome" class="titulopequeno">
                    O ambiente onde se desenvolve o estágio possui recursos e materiais para o desenvolvimento das atividades planejadas.
                    <strong style="color: #8B5558">*</strong></label>
                <br>
                <select name="opc2" id="opc2" class="boxcadastrar">
                    <option value="sim" {{ isset($dados['opc2']) && $dados['opc2'] == 'sim' ? 'selected' : '' }}>Sim
                    </option>
                    <option value="parcialmente"
                        {{ isset($dados['opc2']) && $dados['opc2'] == 'parcialmente' ? 'selected' : '' }}>Parcialmente
                    </option>
                    <option value="nao" {{ isset($dados['opc2']) && $dados['opc2'] == 'nao' ? 'selected' : '' }}>Não
                    </option>
                </select>
                <br><br>

                <label for="nome" class="titulopequeno">
                    Os estagiários recebem apoio necessário da gestão da escola para realização de suas atividades.
                    <strong style="color: #8B5558">*</strong></label>
                <br>
                <select name="opc3" id="opc3" class="boxcadastrar">
                    <option value="sim" {{ isset($dados['opc3']) && $dados['opc3'] == 'sim' ? 'selected' : '' }}>Sim
                    </option>
                    <option value="parcialmente"
                        {{ isset($dados['opc3']) && $dados['opc3'] == 'parcialmente' ? 'selected' : '' }}>Parcialmente
                    </option>
                    <option value="nao" {{ isset($dados['opc3']) && $dados['opc3'] == 'nao' ? 'selected' : '' }}>Não
                    </option>
                </select>
                <br><br>

                <label for="nome" class="titulopequeno">
                    Os supervisores de estágio acompanham e auxiliam os na solução de problemas e/ou dificuldades.
                    <strong style="color: #8B5558">*</strong></label>
                <br>
                <select name="opc4" id="opc4" class="boxcadastrar">
                    <option value="sim" {{ isset($dados['opc4']) && $dados['opc4'] == 'sim' ? 'selected' : '' }}>Sim
                    </option>
                    <option value="parcialmente"
                        {{ isset($dados['opc4']) && $dados['opc4'] == 'parcialmente' ? 'selected' : '' }}>Parcialmente
                    </option>
                    <option value="nao" {{ isset($dados['opc4']) && $dados['opc4'] == 'nao' ? 'selected' : '' }}>Não
                    </option>
                </select>
                <br><br>

                <label for="nome" class="titulopequeno">
                    As atividades desenvolvidas pelos estudantes são compaatíveis com o curso e permitem que eles apliquem os conhecimentos teóricos e práticos obtidos em sua formação.
                    <strong style="color: #8B5558">*</strong></label>
                <br>
                <select name="opc5" id="opc5" class="boxcadastrar">
                    <option value="sim" {{ isset($dados['opc5']) && $dados['opc5'] == 'sim' ? 'selected' : '' }}>Sim
                    </option>
                    <option value="parcialmente"
                        {{ isset($dados['opc5']) && $dados['opc5'] == 'parcialmente' ? 'selected' : '' }}>Parcialmente
                    </option>
                    <option value="nao" {{ isset($dados['opc5']) && $dados['opc5'] == 'nao' ? 'selected' : '' }}>Não
                    </option>
                </select>
                <br><br>

                {{-- Parte de comentarios --}}

                <label for="nome" class="titulopequeno">Comentários sobre os aspectos observados durante a visita.<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="3_l1" id="3_l1" maxlength="87"
                    value="{{ $dados['3_l1'] ?? '' }}"required><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <input class="boxcadastrar" type="text" name="3_l2" id="3_l2" maxlength="87"
                    value="{{ $dados['3_l2'] ?? '' }}"required><br>
                <input class="boxcadastrar" type="text" name="3_l3" id="3_l3" maxlength="87"
                    value="{{ $dados['3_l3'] ?? '' }}"required><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                {{-- Quarta questao --}}
                <label for="nome" class="titulopequeno">Foi identificado algum desafio à implementação dos Planos de atividades do estágio? Qual(is)?<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="4_l1" id="4_l1" maxlength="86"
                    value="{{ $dados['4_l1'] ?? '' }}"required><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <input class="boxcadastrar" type="text" name="4_l2" id="4_l2" maxlength="86"
                    value="{{ $dados['4_l2'] ?? '' }}"required><br>
                <input class="boxcadastrar" type="text" name="4_l3" id="4_l3" maxlength="86"
                    value="{{ $dados['4_l3'] ?? '' }}"required><br>
                <input class="boxcadastrar" type="text" name="4_l4" id="4_l4" maxlength="86"
                    value="{{ $dados['4_l4'] ?? '' }}"required><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>

                {{-- Quinta questao --}}
                <label for="nome" class="titulopequeno">Registre informações sobre aspectos exitosos identificados nos estágios realizados neste campo:<strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="5_l1" id="5_l1" maxlength="86"
                    value="{{ $dados['5_l1'] ?? '' }}"required><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <input class="boxcadastrar" type="text" name="5_l2" id="5_l2" maxlength="86"
                    value="{{ $dados['5_l2'] ?? '' }}"required><br>
                <input class="boxcadastrar" type="text" name="5_l3" id="5_l3" maxlength="86"
                    value="{{ $dados['5_l3'] ?? '' }}"required><br>
                <input class="boxcadastrar" type="text" name="5_l4" id="5_l4" maxlength="86"
                    value="{{ $dados['5_l4'] ?? '' }}"required><br>


                {{-- Sexta questão --}}
                    <label for="nome" class="titulopequeno">Sugestões apresentadas durante a visita: <strong
                        style="color: #8B5558">*</strong></label><br>
                <input class="boxcadastrar" type="text" name="6_l1" id="6_l1" maxlength="86"
                    value="{{ $dados['6_l1'] ?? '' }}"required><br>
                <div class="invalid-feedback"> Por favor preencha esse campo</div>
                <input class="boxcadastrar" type="text" name="6_l2" id="6_l2" maxlength="86"
                    value="{{ $dados['6_l2'] ?? '' }}"required><br>
                <input class="boxcadastrar" type="text" name="6_l3" id="6_l3" maxlength="86"
                    value="{{ $dados['6_l3'] ?? '' }}"required><br>
                <input class="boxcadastrar" type="text" name="6_l4" id="6_l4" maxlength="86"
                    value="{{ $dados['6_l4'] ?? '' }}"required><br>

            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>



            </form>

        </div>
    </div>
    </div>
@endsection
