<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admission Test - Kab Gianyar</title>
    <meta name="description" content="Sistem admission test untuk kalangan kabupaten gianyar">
    <meta name="keywords" content="kabupaten Gianyar, gianyar, test, cpns">
    <meta name="author" content="ProkitBali">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="version" content="2.1.0">

    <!-- favicon -->
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon">

    <!-- Tailwind + App CSS -->
    @vite('resources/css/apps.css')

    <!-- Livewire Styles -->
    @livewireStyles
  </head>
  
  <body class="font-rubik text-base text-slate-900">
    <div class="content">
      {{ $slot }}
    </div>

    @livewireScripts
  </body>
</html>
