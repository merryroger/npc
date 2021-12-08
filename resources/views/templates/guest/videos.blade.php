@extends($view)

@section('styles')
    @include('styles/substyles/videos_page')
@endsection

@section('js')
    <script src="/js/video.js" type="text/javascript"></script>
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
    <div id="video_frame_pad" class="off">
        <div class="dad__panel"></div>
        <iframe id="video_frame"></iframe>
        <section id="video_frame_panel">
            <div class="vf__title"></div>
            <div class="vf__controls">
                <span onclick="return closeMovie(this)">✖</span>
            </div>
        </section>
    </div>
@endsection
