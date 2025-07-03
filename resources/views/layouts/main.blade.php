
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title' , 'Urban Media')</title>
    @include('includes.head')
  
</head>

<body >

    @include('includes.header')
    @include('includes.sidebar')

            @yield('content')
            @include('includes.footer')

    <!-- Import Js Files -->
    @include('includes.script')

    @stack('scripts')
</body>

</html>