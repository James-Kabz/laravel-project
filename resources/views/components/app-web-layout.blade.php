<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My Application' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        {{-- Header content slot --}}
        {{ $header ?? '' }}
    </header>
    <main class="container mx-auto px-4">
        {{-- Main content slot --}}
        {{ $slot }}
    </main>
    {{-- 
    <footer>
        @include('layouts.footer')
    </footer> --}}

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
