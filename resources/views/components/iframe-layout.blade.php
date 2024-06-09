<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#ffffff">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>IPZ Master</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        <link rel="stylesheet" href="https://www.uzh.ch/static/magnolia/assets/css/main.css" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>
    <body class="iframe-body">
        {{ $slot }}
    </body>
</html>
