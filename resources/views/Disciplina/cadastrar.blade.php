<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route("disciplinas.store")}}" method="post">
        @csrf
        <label for="">Disciplinas: </label>
        <input type="text" name="nome">
        <input type="submit" value="Cadastrar disciplinas">
    </form>
</form>
</body>
</html>


