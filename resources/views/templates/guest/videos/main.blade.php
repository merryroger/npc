<article>
    <h2>Видео</h2>
    @if($capacity == 0)
        <div class="empty__line">Нет записей</div>
    @else
        <nav class="video__pad">
        @foreach($videos as $video)
            {!! $video !!}
        @endforeach
            <!--iframe width="560" height="315" src="https://www.youtube.com/embed/_VW0FlbmG3Y"//-->
            <!--iframe width="280" height="160" src="https://www.youtube.com/embed/NA-scdkEj8Q" loading="lazy"
                    srcdoc="<style>@import 'http://npc.local/styles/yt.css'</style>
                            <a href='https://www.youtube.com/embed/NA-scdkEj8Q?autoplay=1'>
                                <img loading='lazy' src='https://img.youtube.com/vi/NA-scdkEj8Q/hqdefault.jpg' alt='YouTube video player'>
                                <span>▶</span>
                            </a>"
                    frameborder="0"
                    modestbranding="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    title="YouTube video player">
            </iframe-->
        </nav>
    @endif
</article>
