<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Startups Campfire</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/amazeui.datetimepicker.css') }}"/>
    <link href="{{ asset('css/ripples.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/scamp.css') }}" rel="stylesheet">
    <link href="{{ asset('css/share.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    @include('front.partials.navbar')
    <div class="container">
        @include('front.partials.modal_search')
        @yield('content')
        @include('front.partials.footer')
    </div>
</body>
<script src="{{ asset('scripts/jquery.min.js') }}"></script>
<script src="{{ asset('scripts/share.min.js') }}"></script>
<script src="{{ asset('scripts/bootstrap.min.js') }}"></script>
<script src="{{ asset('scripts/amazeui.datetimepicker.min.js') }}"></script>
<script src="{{ asset('scripts/jquery.textcomplete.js') }}"></script>
<script src="{{ asset('scripts/material.min.js') }}"></script>
<script src="{{ asset('scripts/ripples.min.js') }}"></script>
<script src="{{ asset('scripts/scamp.js') }}"></script>
<script>
    $(function () {
        $.material.init();
    });
</script>
</html>
