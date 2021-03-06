<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>НПЦ по охране памятников истории и культуры Курганской области</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <style>
        @include('styles/fonts')
        @include('styles/media/over_1920')
        @include('styles/media/between_1200_1920')
        @include('styles/media/between_890_1199')
        @include('styles/media/less_890')
        @include('styles/default')
        @if ($user)
            @include('styles/substyles/mcp')
        @endif
        @yield('styles')
    </style>
    <script src="/js/common.js" type="text/javascript"></script>
    <script src="/js/ajax.js" type="text/javascript"></script>
    <script src="/js/md5.js" type="text/javascript"></script>
    <script src="/js/mainmenu.js" type="text/javascript"></script>
    <script src="/js/search.js" type="text/javascript"></script>
    <script src="/js/popupmsgs.js" type="text/javascript"></script>
    @yield('js')
    @if ($user)
        <script src="/js/cms/mcp.js" type="text/javascript"></script>
    @endif
</head>
<body>
@include('templates/header')
<section id="mainpad">
    @yield('left_aside')
    @yield('main_sheet')
    @yield('right_aside')
</section>
<section id="news_band">
    @yield('newslist')
</section>
@include('templates/footer', ['menu' => $menu])
@if (session()->has('errors'))
    <script>popupMessenger.fire('{!! json_encode(session()->get('errors')) !!}', '{!! trans('flasherrors.error') !!}')</script>
    @php(session()->forget('errors'))
@endif
</body>
</html>
