@extends('templates.app')

@section('body')
    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Termo de encaminhamento</h1>
        </div>
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif

        <hr style="color:#5C1C26; background-color: #5C1C26">

        <form action="{{ route('estagio.documentos.termo-de-encaminhamento.store', ['id' => $estagio->id]) }}"method="post">
            @csrf

            
            <label for="nome" class="titulopequeno">Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicao" id="instituicao" placeholder="Digite o nome da instituição onde será feito o estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Nome<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome" id="nome" placeholder="Digite o nome do discente"
                value="{{ $aluno->nome_aluno }}" readonly style="background: #eee; " required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Curso<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="curso" id="curso" placeholder="Digite o nome do curso"
                value="{{ $aluno->curso->nome }}" readonly style="background: #eee; " required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            
            <label for="nome" class="titulopequeno">Periodo<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="periodo" id="periodo" placeholder="Digite o periodo do curso"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Ano/Etapa/Modalidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="ano_etapa" id="ano_etapa" placeholder="Digite o Ano/Etapa/Modalidade do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Estágio Supervisionado<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="versao_estagio" id="versao_estagio" placeholder="Digite qual o Estágio Supervisionado"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Data de Início do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="data_inicio" id="data_inicio" placeholder="Digite qual a data e o mês de início do estágio EX: 23 de Ago"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Data de Fim do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="data_fim" id="data_fim" placeholder="Digite qual a data e o mês de fim do estágio EX: 23 de Ago"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Ano do Estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="ano" id="ano" placeholder="Digite o Ano do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Nome do Supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="nome_supervisor" id="nome_supervisor" placeholder="Digite o Nome do Supervisor"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">CPF do Supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cpf_supervisor" id="cpf_supervisor" placeholder="Digite o CPF do Supervisor"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Formação do Supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="formação_supervisor" id="formação_supervisor" placeholder="Digite a Formação do Supervisor"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Instituição do Supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="instituicao_estagio" id="instituicao_estagio" placeholder="Digite a Instituição do Supervisor"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Telefone do Supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="telefone_supervisor" id="telefone_supervisor" placeholder="Digite o Telefone do Supervisor"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">E-mail do Supervisor<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="email_supervisor" id="email_supervisor" placeholder="Digite o E-mail do Supervisor"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Cidade do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade_estágio" id="cidade_estágio" placeholder="Digite a Cidade do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Dia atual:<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="dia_atual" id="dia_atual" placeholder="Digite o dia atual"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>
            

            <label for="nome" class="titulopequeno">Mês atual:<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="mes_atual" id="mes_atual" placeholder="Digite o mês atual"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">CNPJ do estágio:<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cnpj_estagio" id="cnpj_estagio" placeholder="Digite o CNPJ do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Local do estágio:<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="local_estagio" id="local_estagio" placeholder="Digite o local do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Endereço do estágio:<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="endereco_estagio" id="endereco_estagio" placeholder="Digite o endereço do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Nº<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="n_estagio" id="n_estagio" placeholder="Digite o número do endereço do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Complemento<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="complemento_estagio" id="complemento_estagio" placeholder="Digite o complemento do endereço do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">CEP<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cep_estagio" id="cep_estagio" placeholder="Digite o CEP do endereço do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Bairro<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="bairro_estagio" id="bairro_estagio" placeholder="Digite o bairro do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Cidade<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cidade_estagio" id="cidade_estagio" placeholder="Digite a cidade do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Estado<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="estado_estagio" id="estado_estagio" placeholder="Digite o estado do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Nome do Representante legal da Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="representantelegal_estagio" id="representantelegal_estagio" placeholder="Digite o nome do Representante legal da Instituição"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Cargo do Representante legal da Instituição<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="cargo_representantelegal" id="cargo_representantelegal" placeholder="Digite o cargo do Representante legal da Instituição"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>


            <label for="nome" class="titulopequeno">Horário do estágio<strong style="color: #8B5558">*</strong></label>
            <br>
            <input class="boxcadastrar" type="text" name="horario_estagio" id="horario_estagio" placeholder="Digite o horário do estágio"
                required><br><br>
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>
            


            <br><br>
            <div class="botoessalvarvoltar">
                <input type="button" value="Voltar" href="{{ url('/home/') }}"
                    onclick="window.location.href='{{ url('/home/') }}'" class="botaovoltar">
                <input class="botaosalvar" type="submit" value="Salvar">
            </div>


        </form>

    </div>
    </div>
@endsection
