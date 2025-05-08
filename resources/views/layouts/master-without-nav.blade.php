<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | DAMIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    <link href="{{ asset('css/custom_styles.css') }}" rel="stylesheet">


    {{-- <link rel="stylesheet" href="{{ asset('build/css/background.css') }}"> --}}
    @include('layouts.head-css')
</head>

@yield('body')

@yield('content')

@include('layouts.vendor-scripts')
</body>

</html>
