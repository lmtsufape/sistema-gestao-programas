<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
  
  O/a discente {{ $aluno->user->name}} enviou o relatório final referente 
  ao programa {{ $vinculo->programa}}, que teve inicio em {{$vinculo->data_inicio}}. <br/>
  Nesse programa, o orientado trabalhou {{$vinculo->quantidade_horas}} horas. <br/><br/>
  
  O relatório final submetido está em anexo. <br/> <br/>

  Por favor, avalie o relatório. <br>

  <hr/>
  <form action="{{route('vinculos.avaliarRelFinal')}}" method="POST">
    @csrf
    @method('POST')
    <input type="hidden" name="id_vinculo" value="{{$vinculo->id}}">
    <input type="radio" name="status_relatorio" id="status_relatorio" value="APROVADO" checked/> Aprovado
    <input type="radio" name="status_relatorio" id="status_relatorio" value="REPROVADO"/> Reprovado
    <br/><br/>
    Observação:<br/>
    <textarea name="observacao" id="observacao" style="width: 40%; height: 40px;" required></textarea><br/><br/>
    <button class="submit" type="submit">Enviar</button>
  </form>

</body>
</html>

