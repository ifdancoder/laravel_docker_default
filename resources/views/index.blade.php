<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>K-Telecom-Task</title>

    @Vite(['resources/css/app.css', 'resources/css/tabler.min.css', 'resources/css/tabler-vendors.min.css', 'resources/css/tabler-payments.min.css', 'resources/css/tabler-flags.css', 'resources/css/demo.min.css'])

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body class="layout-fluid">

    @Vite(['resources/js/demo-theme.min.js'])

    <div id="app">
    </div>

    @Vite(['resources/js/app.js', 'resources/js/tabler.min.js', 'resources/libs/apexcharts/dist/apexcharts.min.js', 'resources/libs/jsvectormap/dist/js/jsvectormap.min.js', 'resources/libs/jsvectormap/dist/maps/world.js', 'resources/libs/jsvectormap/dist/maps/world-merc.js', 'resources/js/demo.min.js'])
</body>

</html>
