@extends("templates.app")

@section("body")

    <div class="container">
        <h1><strong>Frequência mensal</strong></h1><br/>

        <form id="form_frequencia_mensal" action="{{route('vinculos.salvarFrequenciaMensal')}}" method="post">
            @csrf
            <input type="hidden" id="idVinculo" name="idVinculo" value="{{$idVinculo}}"/>
            <div class="row">
                <div class="container form-group col-lg-4  ">
                    <label for="mes" class="teste-1"></label>
                    <select name="mes" id="mes" class="input-modal-create form-control">
                        <option value="" selected disabled>Selecione o mês</option>
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
            </div><br/><br/>

            <div id="formulario_frequencia"></div>

            <div id="informacoes_frequencia" hidden>
                <label>Situação: </label>
                <label id="situacao"></label>

                <br/><br/>

                <label>Observação: </label>
                <label id="observacao"></label>

                <br/>
            </div>

            <br/><br/><input id="botao" class="btn btn-success" type="submit" style="width: 200px;" value="Salvar"/>

        </form>
    </div>

    <script>
        $("#mes").change( function(){
            let qtdDias;
            let formulario = "";
            $("#formulario_frequencia").html('');
    
            //verificando quantos dias tem o mes
            mes = $(this).val();
            meses_30 = ['4', '6', '9', '11']
            
            if (mes == 2){
                qtdDias = 29;
            } else if (meses_30.includes(mes)){
                qtdDias = 30;
            } else{
                qtdDias = 31;
            }

            //fazendo colunas do formulario
            formulario += `
            <div class="container row" style="margin-left: 5rem">
                <div class="col-2" style="background-color: #0D2579">
                    <label class="text-light">Dias/Horas</label>
                </div>
                <div class="col-2 " style="background-color: #0D2579">
                    <label class="text-light">1h</label>
                </div>
                <div class="col-2" style="background-color: #0D2579">
                    <label class="text-light">2h</label>
                </div>
                <div class="col-2" style="background-color: #0D2579">
                    <label class="text-light">3h</label>
                </div>
                <div class="col-2" style="background-color: #0D2579">
                    <label class="text-light">4h</label>
                </div>    
            </div>
        `;

            for (i = 1; i <= qtdDias; i++){
                formulario += `
                <div class="container row" style="margin-left: 5rem">
                    <div class="col-2 p-3" style="background-color: #0D2579">
                        <label class="text-white"> Dia ${i}</label>
                    </div>
                    <div class="col-2 bg-light p-3 ">
                        <input type="radio" class="dia" id="dia${i}_1" name="dia${i}" value="1">
                    </div>
                    <div class="col-2 bg-light p-3 ">
                        <input type="radio" class="dia" id="dia${i}_2" name="dia${i}" value="2">
                    </div>
                    <div class="col-2 bg-light p-3 ">
                        <input type="radio" class="dia" id="dia${i}_3" name="dia${i}" value="3">
                    </div>
                    <div class="col-2 bg-light p-3 ">
                        <input type="radio" class="dia" id="dia${i}_4" name="dia${i}" value="4">
                    </div>    
                </div><br/>
                `; 
            }

            $("#formulario_frequencia").html(formulario);

            // Preenchendo os radio-buttons com as informacoes que tem no banco de dados
            $.get('/getFrequenciaMensal/' + {{$idVinculo}} + '/' + mes, function (frequenciaMensal) {
                
                if(frequenciaMensal == "nao existe"){

                    $("#informacoes_frequencia").attr("hidden", true);
                    $("#botao").val("Salvar");

                } else{ 
                
                    let frequencia = JSON.parse(frequenciaMensal.frequencia);
                    for(i = 1; i <= 31; i++){
                        dia = 'dia' + i;
                        hora = frequencia[dia];
                        if(hora !== undefined){
                            $("#" +  dia + "_" + hora).attr("checked", "checked");
                        }
                    }
                    
                    $("#situacao").html(frequenciaMensal.status);
                    if (frequenciaMensal.status == "aprovada"){
                        $("#situacao").attr("style", "color: green;");
                    }else if(frequenciaMensal.status == "recusada"){
                        $("#situacao").attr("style", "color: red;");
                    }else{
                        $("#situacao").attr("style", "color: blue;");
                    }

                    $("#observacao").html(frequenciaMensal.observacao)

                    $("#informacoes_frequencia").attr("hidden", false);

                    $("#botao").val("Atualizar");
                }
            });
        });

    </script>

@endsection

