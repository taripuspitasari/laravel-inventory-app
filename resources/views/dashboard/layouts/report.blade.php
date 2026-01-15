<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <style>
        {!! file_get_contents(public_path('css/report.css')) !!}
    </style>
</head>
<body>

@yield('content')

</body>
</html>

