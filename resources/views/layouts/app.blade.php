<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     @include('includes.header')
    
</head>
<body>
<scrip src="{{asset('js/custom.js')}}"></script>


    <div id="app">       
        @include('includes.menu')
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
