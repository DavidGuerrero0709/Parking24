<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} {{ $title ?? '' }} </title>
        <meta name="description" content="{{ $metaDescription ?? 'Meta Description Default' }}">

        {{-- General CSS --}}
        <link rel="stylesheet" href="/assets/css/login.css">

        {{-- FontAwesome Library --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Google Font Library --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@1,300&display=swap" rel="stylesheet">
        


        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/js/app.js', 'resources/css/app.scss'])

    </head>
    <body>
        {{ $slot }}

        {{-- Jquery Library --}}
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>


        {{-- Sweet Alert 2 Library --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        

        {{-- Axios Library --}}
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="{{ asset('assets/js/general.js') }}"></script>
    </body>
</html>
