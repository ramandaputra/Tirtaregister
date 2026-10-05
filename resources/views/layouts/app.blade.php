<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tirta Kepri' }}</title>

    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config & Script -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#006689",
                        "civic-amber": "#FFC10D",
                        "surface-ice": "#F4F8FA",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eaf5ff",
                        "on-surface": "#081e2a",
                        "on-surface-variant": "#3e484f",
                        "primary-container": "#00a4db",
                        "on-primary-container": "#00354a",
                        "on-primary": "#ffffff",
                        "status-success": "#0F9D58"
                    },
                    spacing: {
                        "margin": "2rem",
                        "space-xs": "0.25rem",
                        "space-sm": "0.5rem",
                        "space-md": "1rem"
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface-ice text-on-surface antialiased">

    {{-- Panggil Navbar Komponen di Sini --}}
    @include('layouts.partials.navbar')

    {{-- Content Utama --}}
    <main class="w-full pt-20 bg-surface-ice min-h-screen">
        @yield('content')
    </main>

</body>
</html>