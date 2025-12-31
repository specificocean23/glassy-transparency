<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Council Transparency Dashboard</title>
    @if (file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <script type="module" src="{{ asset('build/assets/app.js') }}"></script>
    @endif
</head>
<body class="bg-slate-950 text-slate-100">
    <div id="app"></div>
</body>
</html>
