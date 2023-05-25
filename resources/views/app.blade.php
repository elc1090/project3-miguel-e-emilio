<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link type="image/png" sizes="16x16" rel="icon" href="assets/icons8-one-ring-color-16.png">
        <link type="image/png" sizes="32x32" rel="icon" href="assets/icons8-one-ring-color-32.png">
        <link type="image/png" sizes="96x96" rel="icon" href="assets/icons8-one-ring-color-96.png">
        <link type="image/png" sizes="120x120" rel="icon" href="assets/icons8-one-ring-color-120.png">
        <link rel="icon" type="image/png" sizes="72x72" href="assets/icons8-one-ring-color-72.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/icons8-one-ring-color-96.png">
        <link rel="icon" type="image/png" sizes="144x144" href="assets/icons8-one-ring-color-144.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/icons8-one-ring-color-192.png">
        <link rel="icon" type="image/png" sizes="512x512" href="assets/icons8-one-ring-color-512.png">
        <link rel="apple-touch-icon" type="image/png" sizes="57x57" href="assets/icons8-one-ring-color-57.png">
        <link rel="apple-touch-icon" type="image/png" sizes="60x60" href="assets/icons8-one-ring-color-60.png">
        <link rel="apple-touch-icon" type="image/png" sizes="72x72" href="assets/icons8-one-ring-color-72.png">
        <link rel="apple-touch-icon" type="image/png" sizes="76x76" href="assets/icons8-one-ring-color-76.png">
        <link rel="apple-touch-icon" type="image/png" sizes="114x114" href="assets/icons8-one-ring-color-114.png">
        <link rel="apple-touch-icon" type="image/png" sizes="120x120" href="assets/icons8-one-ring-color-120.png">
        <link rel="apple-touch-icon" type="image/png" sizes="144x144" href="assets/icons8-one-ring-color-144.png">
        <link rel="apple-touch-icon" type="image/png" sizes="152x152" href="assets/icons8-one-ring-color-152.png">
        <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="assets/icons8-one-ring-color-180.png">
        <link color="#26E07F" rel="mask-icon" href="assets/icons8-one-ring-color-48.svg">
        <meta name="msapplication-square70x70logo" content="assets/icons8-one-ring-color-70.png">
        <meta name="msapplication-TileImage" content="assets/icons8-one-ring-color-144.png">
        <meta name="msapplication-square150x150logo" content="assets/icons8-one-ring-color-150.png">
        <meta name="msapplication-square310x310logo" content="assets/icons8-one-ring-color-310.png">
        <meta name="msapplication-TileColor" content="#C0FFEE">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
