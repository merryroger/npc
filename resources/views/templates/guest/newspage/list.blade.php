@if($capacity > 0)
    <article>
        <h2>Новостная лента</h2>
        <div class="news__preview__pad" data-capacity="{!! $capacity !!}">
            <nav class="news__preview__band">
                @foreach($previews as $preview)
                    {!! $preview !!}
                @endforeach
            </nav>
        </div>
    </article>
@endif
