@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Termo aditivo</h1>
        </div>

        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.UFAPE.termo-aditivo.store', ['id' => $estagio->id]) }}" method="post">
            @csrf

            <h1 class="titulogrande">Concedente</h1>

            <label for="concedente" class="titulopequeno">Concedente<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="concedente" id="concedente"
                value="{{ $dados['concedente'] ?? '' }}" placeholder="Digite o nome da concedente." required><br><br>

            <label for="cnpj_c" class="titulopequeno">CNPJ<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cnpj_c" id="cnpj_c"
                value="{{ $dados['concedente'] ?? '' }}" placeholder="Digite o CNPJ da concedente." required><br><br>

            <label for="endereco_c" class="titulopequeno">Endereço<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco_c" id="endereco_c"
                value="{{ $dados['endereco_c'] ?? '' }}" placeholder="Digite o endereço da concedente." required><br><br>

            <label for="bairro_c" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro_c" id="bairro_c" value="{{ $dados['bairro_c'] ?? '' }}"
                placeholder="Digite o bairro." required><br><br>

            <label for="cep_c" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep_c" id="cep_c" value="{{ $dados['cep_c'] ?? '' }}"
                placeholder="Digite o CEP." required><br><br>

            <label for="cidade_c" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade_c" id="cidade_c" value="{{ $dados['cidade_c'] ?? '' }}"
                placeholder="Digite a cidade da concedente." required><br><br>

            <label for="estado_c" class="titulopequeno">Estado / UF<strong style="color: #8B5558">*</strong></label>
            <br>
            <select aria-label="Default select example" class="boxcadastrar" id="estado_c" name="estado_c">
                <option value="">Selecione</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            </select><br><br>

            <label for="representante_c" class="titulopequeno">Representada por<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="representante_c" id="representante_c"
                value="{{ $dados['representante_c'] ?? '' }}" placeholder="Digite o nome do representante da concedente."
                required><br><br>

            <label for="cargo_c" class="titulopequeno">Cargo do representante<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargo_c" id="cargo_c"
                value="{{ $dados['cargo_c'] ?? '' }}" placeholder="Digite o cargo do representante da concedente."
                required><br><br>

            <label for="email_c" class="titulopequeno">E-mail<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="email_c" id="email_c"
                value="{{ $dados['email_c'] ?? '' }}" placeholder="Digite o e-mail do representante da concedente."
                required><br><br>

            <label for="telefone_c" class="titulopequeno">Telefone<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="telefone_c" id="telefone_c"
                value="{{ $dados['telefone_c'] ?? '' }}" placeholder="Digite o telefone do representante da concedente."
                required><br><br>

            <h1 class="titulogrande">Estagiário</h1>

            <label for="nome_aluno" class="titulopequeno">Nome do estagiário<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome_aluno" id="nome_aluno"
                value="{{ $dados['nome_aluno'] ?? '' }}" placeholder="Digite o nome do estagiário." required><br><br>

            <label for="cpf" class="titulopequeno">CPF<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cpf" id="cpf" value="{{ $dados['cpf'] ?? '' }}"
                placeholder="Digite o CPF do estagiário." required><br><br>

            <label for="rg" class="titulopequeno">RG do estagiário<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="rg" id="rg" value="{{ $dados['rg'] ?? '' }}"
                placeholder="Digite o RG do estagiário." required><br><br>

            <label for="orgao_expd_uf" class="titulopequeno">Orgão de expedição/UF<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="orgao_expd_uf" id="orgao_expd_uf"
                value="{{ $dados['orgao_expd_uf'] ?? '' }}"
                placeholder="Digite o Orgão de expedição/UF do RG do estagiário." required><br><br>

            <label for="data_nasc" class="titulopequeno">Data de nascimento<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="date" name="data_nasc" id="data_nasc"
                value="{{ $dados['data_nasc'] ?? '' }}" placeholder="Digite a data de nascimento do estagiário."
                required><br><br>

            <label for="endereco_e" class="titulopequeno">Endereço do estagiário<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco_e" id="endereco_e"
                value="{{ $dados['endereco_e'] ?? '' }}" placeholder="Digite o endereço do estagiário." required><br><br>

            <label for="bairro_e" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro_e" id="bairro_e"
                value="{{ $dados['bairro_e'] ?? '' }}" placeholder="Digite o bairro." required><br><br>

            <label for="cep_e" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep_e" id="cep_e"
                value="{{ $dados['cep_e'] ?? '' }}" placeholder="Digite o CEP." required><br><br>

            <label for="cidade_e" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade_e" id="cidade_e"
                value="{{ $dados['cidade_e'] ?? '' }}" placeholder="Digite o nome da cidade." required><br><br>

            <label for="estado_e" class="titulopequeno">Estado / UF<strong style="color: #8B5558">*</strong></label>
            <br>
            <select aria-label="Default select example" class="boxcadastrar" id="estado_e" name="estado_e">
                <option value="">Selecione</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            </select><br><br>


            <label for="email_e" class="titulopequeno">E-mail do estagiário<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="email_e" id="email_e"
                value="{{ $dados['email_e'] ?? '' }}" placeholder="Digite um e-mail válido do estagiário."
                required><br><br>

            <label for="telefone_e" class="titulopequeno">Telefone para contato<strong
                    style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="telefone_e" id="telefone_e"
                value="{{ $dados['telefone_e'] ?? '' }}" placeholder="Digite o telefone/celular do estagiário."
                required><br><br>
            <label for="">
                As partes acima nomeadas celebram entre si este TERMO ADITIVO, de acordo com o disposto na Lei 11.788, de 25
                de setembro de 2008 e legislação complementar, mediante as cláusulas e condições a seguir estabelecidas:
            </label>
            <label for="">A(s) cláusula(s) abaixo passa(m) a vigorar com a seguinte redação: ${redacao}
            </label>
            <textarea class="boxcadastrar" type="textarea" name="redacao" id="redacao" value="{{ $dados['redacao'] ?? '' }}"
                placeholder="Escreva." style="width: 100%; height: 100px;" ></textarea>
            <label for="">Mantêm-se todas as demais considerações constantes no TERMO DE COMPROMISSO inicialmente
                firmado.
                E por estarem de acordo, firmam as partes o presente Termo Aditivo em três vias de igual teor para um só
                efeito.</label>
            <br><br>
            <div class="botoessalvarvoltar">
                <a href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}" class="botaovoltar">Voltar</a>
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>

        </form>
    </div>
@endsection
