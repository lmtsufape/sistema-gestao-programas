@extends('templates.app')

@section('body')
    @canany(['admin', 'orientador'])

        <style>
            select[multiple] {
                overflow: hidden;
                background: #f5f5f5;
                width: 100%;
                height: auto;
                padding: 0px 5px;
                margin: 0;
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
                color: #131833;
                margin-right: 15px;
            }

            .boxinfo {
                background: #F5F5F5;
                border-radius: 6px;
                border: 1px #D3D3D3;
                width: 100%;
                padding: 5px;
                box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
            }

            .boxchild {
                background: #FFFFFF;
                box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
                border-radius: 20px;
                padding: 34px;
                width: 65%;
            }

            .bolsa {
                display: flex;
                flex-direction: column;
                align-items: start;
                justify-content: space-evenly;
            }

            .radios {
                margin: 5px;
            }

            .labelTooltip {
                display: flex;
                flex-direction: row;
                justify-content: flex-start;
            }
        </style>
        <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
            @if (session('sucesso'))
                <div class="alert alert-success" style="width: 100%;">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>

            <div class="fundocadastrar">
                <div class="row" style="display: flex; align-items: left;">
                    <h1 class="titulogrande">
                        Adicionar Documentos</h1>
                </div>

                <form action="{{ route('edital.salvar-documentos-vinculo', ['id' => $vinculo->id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <input type="hidden" id="vinculo_id" name="vinculo_id" value="{{$vinculo->id}}">

                    <label class="titulopequeno" for="termo_orientador">Termo do Professor <strong
                            style="color: red">*</strong></label>
                    <input type="file" id="termo_orientador" class="form-control boxcadastrar" name="termo_orientador" value="{{ old('termo_orientador') }}" required>
                    <br>

                    <label class="titulopequeno" for="termo_aluno">Termo do Estudante <strong
                            style="color: red">*</strong></label>
                    <input type="file" id="termo_aluno" class="form-control boxcadastrar" name="termo_aluno" value="{{ old('termo_aluno') }}" required>
                    <br>

                    <label class="titulopequeno" for="historico_escolar">Histórico Escolar do Estudante <strong
                            style="color: red">*</strong></label>
                    <input type="file" id="historico_escolar" class="form-control boxcadastrar" name="historico_escolar" value="{{ old('historico_escolar') }}" required>
                    <br>

                    <label class="titulopequeno" for="comprovante_bancario">Comprovante Bancário </label>
                    <input type="file" id="comprovante_bancario" class="form-control boxcadastrar" name="comprovante_bancario" value="{{ old('comprovante_bancario') }}">
                    <br>


                    <div class="botoessalvarvoltar">
                        <input class="botaovoltar" type="button" value="Voltar" href="{{ route('orientadors.editais-orientador') }}"
                            onclick="window.location.href='{{ route('orientadors.editais-orientador') }}'">
                        <input class="botaosalvar" type="submit" value="Salvar">
                    </div>
                </form>
            </div>
            <br>
            <br>
        </div>

    @endcan
    <script src="{{ mix('js/app.js') }}">
        $('.cpf-autocomplete').inputmask('999.999.999-99');

        document.addEventListener('DOMContentLoaded', function() {
            var cpfInput = document.querySelector('.cpf-autocomplete');
            var url = cpfInput.getAttribute('data-url');

            cpfInput.addEventListener('input', function() {
                var cpfValue = this.value;

                fetch(url)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        var filteredCpfs = data.filter(function(item) {
                            return item.cpf.includes(cpfValue);
                        });
                        filteredCpfs.forEach(function(item) {
                            console.log(item.cpf + ' - ' + item.nome);
                        });
                    })
                    .catch(function(error) {
                        console.log('Ocorreu um erro: ' + error);
                    });
            });
        });
    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
