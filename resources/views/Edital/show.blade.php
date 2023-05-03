@extends("templates.app")

@section("body")

@canany(['admin', 'servidor'])
   
   
   <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="info-container" class="col-md-6">
                <h1> {{$edital->nome}}</h1>
                <!--colocando o icone no paragrafo -->
                <p class="event-city"><ion-icon name="location-outline"></ion-icon>
                    {{$edital->descricao}}
                </p>
                <form action="{{  route('edital.aluno', ['id' => $edital->id])  }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="descricao">CPF do alunoo</label>
                        <input type="text" id="cpf" class="form-control" name="cpf" placeholder="cpf do aluno" required>
                    </div>
                    <div class="form-group">
                        <label for="valor_bolsa">valor da bolsa</label>
                        <input type="number" id="valor_bolsa" class="form-control" name="valor_bolsa" placeholder="valor da bolsa" required>
                    </div>
                    <div class="form-group">
                        <label for="bolsa">tipo da bolsa</label>
                        <input type="text" id="bolsa" class="form-control" name="bolsa" placeholder="bolsa" required>
                    </div>
                    <div class="form-group">
                        <label for="info_complementares">Informações Complementares</label>
                        <input type="text" id="info_complementares" class="form-control" name="info_complementares" placeholder="informações complementares" required>
                    </div>
                    <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                        <input type="button" value="Voltar" href="{{ route('edital.index')}}" onclick="window.location.href='{{ route("edital.index")}}'" style="background: #2D3875;
                        box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                        border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                        line-height: 29px; text-align: center; padding: 5px 15px;">
                        <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                        display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                        font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
                    </div>s
                </form>
                <p>aaaaaaaaaaa</p>
    </div>

@endcan
@endsection