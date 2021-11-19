@extends($view)

@section('styles')
    @include('styles/substyles/news_page')
    @include('styles/substyles/news_aside')
@endsection

@section('js')
    <script src="/js/newsband.js" type="text/javascript"></script>
@endsection

@section('left_aside')
    <aside class="page__aside aside__left">
        {!! $contents['left_aside'] !!}
    </aside>
@endsection

@section('main_sheet')
    <section class="main__sheet news__article">
        {!! $contents['main_sheet'] !!}
    </section>
@endsection

@section('right_aside')
    <aside class="page__aside aside__right">
        {!! $contents['right_aside'] !!}
    </aside>
@endsection

@section('newslist')
    <section class="main__sheet">
        {!! $contents['newslist'] !!}
    </section>
@endsection
