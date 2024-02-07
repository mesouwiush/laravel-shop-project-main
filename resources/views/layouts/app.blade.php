<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    {{-- Navbar Component --}}
    <x-Navigation />

    @yield('content')

    @vite('resources/js/app.js')
</body>
</html>
