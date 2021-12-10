<h2>Видео</h2>
<div class="centered">
    <iframe src="{!! $video['source'] !!}" loading="lazy"
            srcdoc="<html><head><style>@import '{{ config('app.url') }}/styles/yt.css'</style></head>
            <body>
            <a href='{!! $video['source'] !!}?autoplay=1' title='{!! $video['comment'] !!}'>
                <img src='{!! $video['preview'] !!}' alt='{!! $video['comment'] !!}'>
                <span>▶</span>
            </a></body>"
            frameborder="0"
            modestbranding="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            title="{!! $video['comment'] !!}">
    </iframe>
    <a href="/videos" class="all__news">Всё видео</a>
</div>
