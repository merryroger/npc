@extends($view)

@section('styles')
    @include('styles/substyles/news_aside')
    @include('styles/substyles/banners')
    @include('styles/substyles/extras')
@endsection

@section('js')
    <script src="/js/banners.js" type="text/javascript"></script>
@endsection

@section('left_aside')
    <aside class="page__aside aside__left">
        {!! $contents['left_aside'] !!}
    </aside>
@endsection

@section('main_sheet')
    <section class="main__sheet">
        {!! $contents['main_sheet'] !!}
    </section>
@endsection

@section('right_aside')
    <aside class="page__aside aside__right">
        {!! $contents['right_aside'] !!}
    </aside>
@endsection

@section('banners')
    {!! $contents['banners'] !!}
@endsection
