@if($capacity > 0)
<article>
    <h2>Новостная лента</h2>
    <nav class="news__preview__band">
        @foreach($previews as $preview)
            {!! $preview !!}
        @endforeach
    </nav>
</article>
@endif
