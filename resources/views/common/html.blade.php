<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    @stack('html-head-bottom')

</head>
<body>

    @stack('html-body-top')

    @yield('html-body')

    @stack('html-body-bottom')

</body>
</html>
