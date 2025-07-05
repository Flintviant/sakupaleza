<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Sakupaleza </title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    
    @stack('styles')
</head>
<body>
    @yield('content')

    @include('layouts.footer')
    @stack('scripts')

</body>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

</html>
