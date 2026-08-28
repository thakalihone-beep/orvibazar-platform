{{-- <!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'OrviBazar' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/main.css') }}">
    @stack('styles')
</head>

<body>

    <main style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--color-bg-light); padding: var(--spacing-2xl) 0;">
        @yield('content')
    </main>

    @stack('scripts')

</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'OrviBazar')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Main CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/main.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Guest Layout Content - NO FOOTER -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @stack('scripts')
</body>
</html>