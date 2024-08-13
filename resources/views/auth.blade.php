@php
  $component = Route::currentRouteName();
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
  @viteReactRefresh
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


  <!-- Styles -->
  @livewireStyles
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

  @vite(['resources/css/app.css', 'resources/js/' . Route::currentRouteName()])
  @inertiaHead
</head>

<body class="loading authentication-bg-pattern">
  @inertia

  <script src="/lte/assets/js/vendor.min.js"></script>
  <script src="/lte/assets/libs/select2/js/select2.full.min.js"></script>
  <script src="/lte/assets/js/app.min.js"></script>
  @livewireScripts
  {{-- <script src="{{ asset('js/functions.js') }}?v={{ uniqid() }}"></script> --}}

</body>

</html>
