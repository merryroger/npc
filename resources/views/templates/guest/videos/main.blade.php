<article>
    <h2>Видео</h2>
    @if($capacity == 0)
        <div class="empty__line">Нет записей</div>
    @else
        <nav class="video__pad">
            @foreach($videos as $video)
                {!! $video !!}
            @endforeach
        </nav>
    @endif
</article>
