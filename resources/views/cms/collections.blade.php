<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>НПЦ - система управления</title>
    <style>
        @include('styles/fonts')
        @include('styles/cms/default')
        @include('styles/cms/datalist')
        @include('styles/cms/collections')
        @include('styles/substyles/mcp')
    </style>
    <script src="/js/common.js" type="text/javascript"></script>
    <script src="/js/veil.js" type="text/javascript"></script>
    <script src="/js/ajax.js" type="text/javascript"></script>
    <script src="/js/cms/desktop.js" type="text/javascript"></script>
    <script src="/js/cms/collections.js" type="text/javascript"></script>
    <script src="/js/cms/mcp.js" type="text/javascript"></script>
</head>
<body>
    @include('templates/cms/mcp', ['user' => $user])
    <form id="cms_defaults">
        @csrf
    </form>
    @yield('contents')
    @if (session()->has('error'))
        <script>raiseFlashError('{!! session()->get('error') !!}');</script>
    @endif
</body>
</html>