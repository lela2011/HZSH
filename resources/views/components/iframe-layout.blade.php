<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#ffffff">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>HZSH IPZ</title>
        <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        <link rel="stylesheet" href="https://www.uzh.ch/static/magnolia/assets/css/main.css" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>
    <body class="iframe-body">
        {{ $slot }}
    </body>
</html>
