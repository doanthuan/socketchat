<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    @include('chat::layouts.partials.head')
</head>
<body>
@include('chat::layouts.partials.header')

<div class="container">
@yield('content')
</div>

@include('chat::layouts.partials.footer')
</body>
</html>
