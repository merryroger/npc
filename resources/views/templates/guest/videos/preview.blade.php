<div class="video__item__pad">
    <h6>{!! $date !!}</h6>
    <a href="{!! $item['source'] !!}?autoplay=1" style="background-image: url('{!! $item['preview'] !!}')"
       onclick="return viewMovie(this, '{!! $item["source"] !!}')">
        <span>▶</span>
    </a>
    @if ($item['comment'])
        {!! $item['comment'] !!}
    @else
        <p><br/></p>
    @endif
</div>