@extends("templates.app")


@section("body")
    @include("auth.modal_criar_aluno")

    {{-- <x-jet-validation-errors class="mb-4" />
    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif --}}
    @if (session('sucesso'))
    <div class="alert alert-sucess">
        <p style="color: green">{{session('sucesso')}}</p>
    </div>
    @endif
    <br>

    <div class="container-fluid" style="padding-top: 5%">

        <div class="row" style="text-align: left;">
            <h1>Contato</h1>
            <h3 style="padding-top: 10px;">Universidade de Pernambuco (UPE)</h3>
            <p>
                R. Cap. Pedro Rodrigues, Bairro São José - CEP: 55294-902 - Garanhuns - PE<br>
                <strong>Email:</strong> engenhariadesoftware.multicampi@upe.br
            </p>

            <h3>Laboratório Multidisciplinar de Tecnologias Sociais (LMTS)</h3>
            <p style="padding-bottom: 5%;">
                Universidade Federal do Agreste de Pernambuco<br>
                Avenida Bom Pastor, s/n.º, Bairro Boa Vista - CEP: 55292-270 - Garanhuns - PE<br>
                Laboratório 23<br>
                <strong>Email:</strong> lmts@ufape.edu.br
            </p>

        </div>

</div>
@endsection
