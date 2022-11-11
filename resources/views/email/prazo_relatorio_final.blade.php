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
  Olá, {{ $aluno->user->name }}! <br>
  
  Este é um e-mail automático, é apenas um lembrete para enviar o relatório final referente 
  ao programa {{ $vinculo->programa}}, acompanhado por {{ $professor->nome }}.  Caso já tenha 
  enviado, por favor ignore esta mensagem.
</body>
</html>

