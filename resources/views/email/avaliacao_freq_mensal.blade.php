<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
  <title>Document</title>
</head>
<style>
  .submit{
    border: none;
    color: white;
    background-color: blue;
  }
</style>
<body>
  Olá, {{ $professor->nome }}! <br/><br/>
  
  O aluno {{ $aluno->user->name}}, enviou o frequência mensal referente a {{$mes}}
  do programa {{ $vinculo->programa}}, que teve inicio em {{$vinculo->data_inicio}}. <br/>
  Nesse mês, o orientado trabalhou {{$frequenciaMensal->tempo_total}} horas. <br/><br/>
  
  A frequência mensal está abaixo. <br/> <br/>

  Por favor, avalie a frequência mensal. <br/><br/>

  <label style="margin-left: 30px;">1h 2h 3h 4h</label><br/>

  @for ($i = 1; $i <= $qntDiasMes; $i++)
    <label>dia {{$i}} </label>
    <input type="radio" class="dia" disabled {{ isset($frequencia["dia".$i]) && $frequencia["dia".$i] == 1 ? ' checked' : '' }}/>
    <input type="radio" class="dia" disabled {{ isset($frequencia["dia".$i]) && $frequencia["dia".$i] == 2 ? ' checked' : '' }}/>
    <input type="radio" class="dia" disabled {{ isset($frequencia["dia".$i]) && $frequencia["dia".$i] == 3 ? ' checked' : '' }}/>
    <input type="radio" class="dia" disabled {{ isset($frequencia["dia".$i]) && $frequencia["dia".$i] == 4 ? ' checked' : '' }}/>
    <br/>
  @endfor
  <hr/>
  <form action="{{route('vinculos.avaliarFreqMensal')}}" method="POST">
    @csrf
    @method('POST')
    <input type="hidden" name="id_frequencia" value="{{$frequenciaMensal->id}}">
    <input type="radio" name="status" id="status" value="aprovada" checked/> Aprovado
    <input type="radio" name="status" id="status" value="recusada"/> Reprovado
    <br/><br/>
    Observação:<br/>
    <textarea name="observacao" id="observacao" style="width: 40%; height: 40px;" required></textarea><br/><br/>
    <button class="submit" type="submit">Enviar</button>
  </form>

</body>

</html>

