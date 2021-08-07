<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>{{ $data['user']['lastname'] }} {{ $data['user']['name'] }} {{ $data['user']['patronymic'] }}</h2>
    <p><b>Почта:</b> {{ $data['user']['email'] }}</p>
    <p><b>Телефон:</b> {{ $data['user']['telephone'] }}</p>
    <p><b>Курс:</b> {{ $data['course']['title'] }}</p>
    <p><b>Время:</b> {{ $data['lecture']['time'] }}</p>
    <p><b>Кабинет:</b> {{ $data['lecture']['cabinet'] }}</p>
</body>
</html>
