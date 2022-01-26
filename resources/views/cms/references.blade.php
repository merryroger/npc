<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <title>НПЦ - система управления</title>
    <style>
        @include('styles/fonts')
        @include('styles/cms/default')
        @include('styles/cms/references')
        @include('styles/substyles/mcp')
    </style>
    @php($parameters = \Illuminate\Support\Facades\Route::current()->parameters())
    @if (isset($parameters['section']))
        @switch($parameters['section'])
            @case('tags')
            <script src="/js/cms/references/tags/tags.js" type="text/javascript"></script>
            @break
            @case('locations')
            <script src="/js/cms/references/location/locations.js" type="text/javascript"></script>
            <script src="/js/cms/references/location/data_table.js" type="text/javascript"></script>
            @break
        @endswitch
    @endif
    <script src="/js/common.js" type="text/javascript"></script>
    <script src="/js/veil.js" type="text/javascript"></script>
    <script src="/js/ajax.js" type="text/javascript"></script>
    <script src="/js/cms/desktop.js" type="text/javascript"></script>
    <script src="/js/cms/references.js" type="text/javascript"></script>
    <script src="/js/cms/references/data_tables.js" type="text/javascript"></script>
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
