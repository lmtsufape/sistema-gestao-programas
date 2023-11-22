@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Termo de compromisso</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UFAPE.termo-de-compromisso.store', ['id' => $estagio->id]) }}" method="post">
            @csrf

            
            <!-- Concedente -->
            <label for="nome_concedente" class="titulopequeno">Nome da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome_concedente" id="nome_concedente"
                placeholder="Digite o nome da Concedente"
                value="{{ $dados['nome_concedente'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cnpj" class="titulopequeno">CNPJ da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cnpj" id="cnpj"
                placeholder="Digite o CNPJ da Concedente"
                value="{{ $dados['cnpj'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="endereco_concedente" class="titulopequeno">Endereço da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco_concedente" id="endereco_concedente"
                placeholder="Digite o endereço da Concedente"
                value="{{ $dados['endereco_concedente'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="bairro_concedente" class="titulopequeno">Bairro da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro_concedente" id="bairro_concedente"
                placeholder="Digite o bairro da Concedente"
                value="{{ $dados['bairro_concedente'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cep_concedente" class="titulopequeno">CEP da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep_concedente" id="cep_concedente"
                placeholder="Digite o CEP da Concedente"
                value="{{ $dados['cep_concedente'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cidade_concedente" class="titulopequeno">Cidade da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade_concedente" id="cidade_concedente"
                placeholder="Digite a cidade da Concedente"
                value="{{ $dados['cidade_concedente'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="estado_concedente" class="titulopequeno">Estado da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estado_concedente" id="estado_concedente"
                placeholder="Digite o estado da Concedente"
                value="{{ $dados['estado_concedente'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="representante" class="titulopequeno">Representante da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="representante" id="representante"
                placeholder="Digite o nome do representante da Concedente"
                value="{{ $dados['representante'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="representante_cargo" class="titulopequeno">Cargo do representante<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="representante_cargo" id="representante_cargo"
                placeholder="Digite o cargo do representante da Concedente"
                value="{{ $dados['representante_cargo'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="representante_email" class="titulopequeno">Email do representante<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="email" name="representante_email" id="representante_email"
                placeholder="Digite o email do representante da Concedente"
                value="{{ $dados['representante_email'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="representante_email" class="titulopequeno">Telefone do representante<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="representante_telefone" id="representante_telefone"
                placeholder="Digite o email do representante da Concedente"
                value="{{ $dados['representante_telefone'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>


            <!-- Aluno -->
            <label for="nome_aluno" class="titulopequeno">Nome do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome_aluno" id="nome_aluno"
                placeholder="Digite o nome do Aluno"
                value="{{ $aluno->nome_aluno }}" readonly required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cpf" class="titulopequeno">CPF do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cpf" id="cpf"
                placeholder="Digite o CPF do Aluno"
                value="{{ $aluno->cpf }}" readonly required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="rg" class="titulopequeno">RG do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="rg" id="rg"
                placeholder="Digite o RG do Aluno"
                value="{{ $dados['rg'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="org_expedicao" class="titulopequeno">Órgão de Expedição do RG<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="org_expedicao" id="org_expedicao"
                placeholder="Digite o órgão de expedição do RG"
                value="{{ $dados['org_expedicao'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="nascimento" class="titulopequeno">Data de Nascimento do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="date" name="nascimento" id="nascimento"
                value="{{ $dados['nascimento'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="endereco" class="titulopequeno">Endereço do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco" id="endereco"
                placeholder="Digite o endereço do Aluno"
                value="{{ $dados['endereco'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="bairro" class="titulopequeno">Bairro do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro" id="bairro"
                placeholder="Digite o bairro do Aluno"
                value="{{ $dados['bairro'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cep" class="titulopequeno">CEP do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep" id="cep"
                placeholder="Digite o CEP do Aluno"
                value="{{ $dados['cep'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="cidade" class="titulopequeno">Cidade do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade" id="cidade"
                placeholder="Digite a cidade do Aluno"
                value="{{ $dados['cidade'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="estado" class="titulopequeno">Estado do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estado" id="estado"
                placeholder="Digite o estado do Aluno"
                value="{{ $dados['estado'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="email" class="titulopequeno">E-mail do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="email" name="email" id="email"
                placeholder="Digite o e-mail do Aluno"
                value="{{ $dados['email'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="telefone" class="titulopequeno">Telefone do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="tel" name="telefone" id="telefone"
                placeholder="Digite o telefone do Aluno"
                value="{{ $dados['telefone'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <!-- Cláusula 2 -->
            <label for="aluno_curso" class="titulopequeno">Curso do aluno<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="aluno_curso" id="aluno_curso"
                placeholder="Digite o curso do Aluno"
                value="{{ $curso->nome }}" readonly required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="aluno_curso" class="titulopequeno">Componente Curricular<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="disciplina" id="disciplina"
                placeholder="Digite o nome da componente curricular"
                value="{{ $disciplina->nome }}" readonly required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="aluno_curso" class="titulopequeno">Período<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo"
                placeholder="Digite o seu período"
                value="{{ $dados['periodo'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>
            <!-- Cláusula 3 -->
            <label for="departamento" class="titulopequeno">Departamento<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="departamento" id="departamento"
                placeholder="Digite o departamento"
                value="{{ $dados['departamento'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="endereco_concedente" class="titulopequeno">Endereço da concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco_concedente" id="endereco_concedente"
                placeholder="Digite o endereço da Concedente"
                value="{{ $dados['endereco_concedente'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="data_inicio" class="titulopequeno">Data de Início do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="data_inicio" id="data_inicio"
                value="{{ $estagio->data_inicio }}" readonly required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="data_fim" class="titulopequeno">Data de Término do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="data_fim" id="data_fim"
                value="{{ $estagio->data_fim }}" readonly required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label class="titulopequeno">Carga horária na UFAPE:</label>
            <br>
            <label>
                <input type="checkbox" name="dias_ufape[]" value="segunda" {{ in_array('segunda', $dados['dias_ufape'] ?? []) ? 'checked' : '' }}>
                Segunda-feira
            </label>
            <label>
                <input type="checkbox" name="dias_ufape[]" value="terca" {{ in_array('terca', $dados['dias_ufape'] ?? []) ? 'checked' : '' }}>
                Terça-feira
            </label>
            <label>
                <input type="checkbox" name="dias_ufape[]" value="quarta" {{ in_array('quarta', $dados['dias_ufape'] ?? []) ? 'checked' : '' }}>
                Quarta-feira
            </label>
            <label>
                <input type="checkbox" name="dias_ufape[]" value="quinta" {{ in_array('quinta', $dados['dias_ufape'] ?? []) ? 'checked' : '' }}>
                Quinta-feira
            </label>
            <label>
                <input type="checkbox" name="dias_ufape[]" value="sexta" {{ in_array('sexta', $dados['dias_ufape'] ?? []) ? 'checked' : '' }}>
                Sexta-feira
            </label>
            <br><br>

            <!-- Horários na UFAPE -->
            <label class="titulopequeno">Horários na UFAPE (Segunda a Sexta)</label>
            <br>
            <label for="horario_ufape_segunda" class="titulopequeno">Segunda-feira</label>
            <input class="boxcadastrar" type="text" name="horario_ufape_segunda" id="horario_ufape_segunda"
                placeholder="Digite o horário na UFAPE (Segunda)"
                value="{{ $dados['horario_ufape_segunda'] ?? '' }}"><br><br>

            <label for="horario_ufape_terca" class="titulopequeno">Terça-feira</label>
            <input class="boxcadastrar" type="text" name="horario_ufape_terca" id="horario_ufape_terca"
                placeholder="Digite o horário na UFAPE (Terça)"
                value="{{ $dados['horario_ufape_terca'] ?? '' }}"><br><br>

            <label for="horario_ufape_quarta" class="titulopequeno">Quarta-feira</label>
            <input class="boxcadastrar" type="text" name="horario_ufape_quarta" id="horario_ufape_quarta"
                placeholder="Digite o horário na UFAPE (Quarta)"
                value="{{ $dados['horario_ufape_quarta'] ?? '' }}"><br><br>

            <label for="horario_ufape_quinta" class="titulopequeno">Quinta-feira</label>
            <input class="boxcadastrar" type="text" name="horario_ufape_quinta" id="horario_ufape_quinta"
                placeholder="Digite o horário na UFAPE (Quinta)"
                value="{{ $dados['horario_ufape_quinta'] ?? '' }}"><br><br>

            <label for="horario_ufape_sexta" class="titulopequeno">Sexta-feira</label>
            <input class="boxcadastrar" type="text" name="horario_ufape_sexta" id="horario_ufape_sexta"
                placeholder="Digite o horário na UFAPE (Sexta)"
                value="{{ $dados['horario_ufape_sexta'] ?? '' }}"><br><br>                

            
                <!-- Carga horária no Estágio -->
                <label class="titulopequeno">Carga horária no Estágio:</label>
                <br>
                <label>
                    <input type="checkbox" name="dias_estagio[]" value="segunda" {{ in_array('segunda', $dados['dias_estagio'] ?? []) ? 'checked' : '' }}>
                    Segunda-feira
                </label>
                <label>
                    <input type="checkbox" name="dias_estagio[]" value="terca" {{ in_array('terca', $dados['dias_estagio'] ?? []) ? 'checked' : '' }}>
                    Terça-feira
                </label>
                <label>
                    <input type="checkbox" name="dias_estagio[]" value="quarta" {{ in_array('quarta', $dados['dias_estagio'] ?? []) ? 'checked' : '' }}>
                    Quarta-feira
                </label>
                <label>
                    <input type="checkbox" name="dias_estagio[]" value="quinta" {{ in_array('quinta', $dados['dias_estagio'] ?? []) ? 'checked' : '' }}>
                    Quinta-feira
                </label>
                <label>
                    <input type="checkbox" name="dias_estagio[]" value="sexta" {{ in_array('sexta', $dados['dias_estagio'] ?? []) ? 'checked' : '' }}>
                    Sexta-feira
                </label>
                <br><br>


            <!-- Horários de Estágio -->
            <label class="titulopequeno">Horários no estágio (Segunda a Sexta)</label>
            <br>
            <label for="horario_estagio_segunda" class="titulopequeno">Segunda-feira</label>
            <input class="boxcadastrar" type="text" name="horario_estagio_segunda" id="horario_estagio_segunda"
                placeholder="Digite o horário de estágio (Segunda)"
                value="{{ $dados['horario_estagio_segunda'] ?? '' }}"><br><br>

            <label for="horario_estagio_terca" class="titulopequeno">Terça-feira</label>
            <input class="boxcadastrar" type="text" name="horario_estagio_terca" id="horario_estagio_terca"
                placeholder="Digite o horário de estágio (Terça)"
                value="{{ $dados['horario_estagio_terca'] ?? '' }}"><br><br>

            <label for="horario_estagio_quarta" class="titulopequeno">Quarta-feira</label>
            <input class="boxcadastrar" type="text" name="horario_estagio_quarta" id="horario_estagio_quarta"
                placeholder="Digite o horário de estágio (Quarta)"
                value="{{ $dados['horario_estagio_quarta'] ?? '' }}"><br><br>

            <label for="horario_estagio_quinta" class="titulopequeno">Quinta-feira</label>
            <input class="boxcadastrar" type="text" name="horario_estagio_quinta" id="horario_estagio_quinta"
                placeholder="Digite o horário de estágio (Quinta)"
                value="{{ $dados['horario_estagio_quinta'] ?? '' }}"><br><br>

            <label for="horario_estagio_sexta" class="titulopequeno">Sexta-feira</label>
            <input class="boxcadastrar" type="text" name="horario_estagio_sexta" id="horario_estagio_sexta"
                placeholder="Digite o horário de estágio (Sexta)"
                value="{{ $dados['horario_estagio_sexta'] ?? '' }}"><br><br>

            <!-- Cláusula 4 -->
            <label for="atividades_estagiario" class="titulopequeno">Atividades do estagiário<strong style="color: #8B5558">*</strong></label>
            <br>
            <textarea class="boxcadastrar" name="atividades_estagiario" id="atividades_estagiario" rows="4"
                placeholder="Digite as atividades do estagiário" required>{{ $dados['atividades_estagiario'] ?? '' }}</textarea><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="atividades_estagiario" class="titulopequeno">Carga horária total da disciplina<strong style="color: #8B5558">*</strong></label>
            <br>
            <textarea class="boxcadastrar" name="carga_horaria_total" id="carga_horaria_total" rows="4"
                placeholder="Digite a carga horária total da disciplina" required>{{ $dados['atividades_estagiario'] ?? '' }}</textarea><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <!-- Cláusula 8 -->
            <label for="orientador" class="titulopequeno">Orientador<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="orientador" id="orientador"
                placeholder="Digite o nome do orientador"
                value="{{ $dados['orientador'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <!-- Cláusula 9 -->
            <label for="supervisor_nome" class="titulopequeno">Nome do supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisor_nome" id="supervisor_nome"
                placeholder="Digite o nome do supervisor"
                value="{{ $dados['supervisor_nome'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>

            <label for="supervisor_cargo" class="titulopequeno">Cargo do supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="supervisor_cargo" id="supervisor_cargo"
                placeholder="Digite o cargo do supervisor"
                value="{{ $dados['supervisor_cargo'] ?? '' }}" required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div>


            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>
            
        </form>
    </div>
@endsection
