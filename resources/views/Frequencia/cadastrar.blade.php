@extends("templates.app")

@section("body")

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
            color: #1a2147;
        }
        .boxinfo{
            background: #F5F5F5;
            border-radius: 6px;
            border: 1px #D3D3D3;
            width: 100%;
            padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
            height: 40px;
        }
        .boxchild{
            background: #FFFFFF;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
            padding: 34px;
            width: 65%
        }
    </style>
    <div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
        <div class="boxchild">
            <div class="row">
                <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #2D3875;">
                Registrar Frequência Mensal</h1>
            </div>
            
            <hr>

            <form id="form_frequencia_mensal" action="" method="post">
                @csrf
                <input type="hidden" id="" name="idVinculo" value=""/>
                <div class="row">
                    <div class="container form-group col-lg-4 ">
                        <label for="mes" class="titulo mt-3"></label>
                        <select name="mes" id="mes" class="boxinfo">
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
                </div><br>

                <div id="formulario_frequencia"></div>

                <div id="informacoes_frequencia" hidden>
                    <label>Situação: </label>
                    <label id="situacao"></label>

                    <br/><br/>

                    <label>Observação: </label>
                    <label id="observacao"></label>

                    <br/>
                </div><br/><br/>
                <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                    <input type="button" value="Voltar" href="{{url("/frequencia/")}}" onclick="window.location.href='{{url("/frequencia/")}}'"
                    style="background: #2D3875; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                    border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                    line-height: 29px; text-align: center; padding: 5px 15px;">

                    <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                    display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                    font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                </div>
            </form>
        </div>
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
            <div class="container row mt-3" style="margin: Auto">
                <div class="col-2" style="background-color: #1a2147;">
                    <label class="text-light">Dias/Horas</label>
                </div>
                <div class="col-2 " style="background-color: #1a2147;">
                    <label class="text-light">1h</label>
                </div>
                <div class="col-2" style="background-color: #1a2147;">
                    <label class="text-light">2h</label>
                </div>
                <div class="col-2" style="background-color: #1a2147;">
                    <label class="text-light">3h</label>
                </div>
                <div class="col-2" style="background-color: #1a2147;">
                    <label class="text-light">4h</label>
                </div>   
                <div class="col-2" style="background-color: #1a2147;">
                    <label class="text-light">5h</label>
                </div>  
            </div>
        `;
            for (i = 1; i <= qtdDias; i++){
                formulario += `
                <div class="container row" style="margin: Auto">
                    <div class="col-2 p-3" style="background-color: #1a2147;">
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
                    <div class="col-2 bg-light p-3 ">
                        <input type="radio" class="dia" id="dia${i}_5" name="dia${i}" value="5">
                    </div>    
                </div><br/>
                `; 
            }
            $("#formulario_frequencia").html(formulario);
            // Preenchendo os radio-buttons com as informacoes que tem no banco de dados
            // $.get('/getFrequenciaMensal/' + id + '/' + mes, function (frequenciaMensal) {
                $.get('/getFrequenciaMensal/' + '/' + mes, function (frequenciaMensal) {
                
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