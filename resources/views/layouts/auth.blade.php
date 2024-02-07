<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-white align-middle lg:overflow-y-hidden overflow-x-hidden">


    @yield('content')

    @vite('resources/js/app.js')
</body>
</html>
