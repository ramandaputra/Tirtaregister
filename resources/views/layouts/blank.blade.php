<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tirta Kepri')</title>
    <!-- Fonts & CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#006689",
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen p-4 md:p-8 flex flex-col items-center">
    @yield('content')
</body>
</html>
