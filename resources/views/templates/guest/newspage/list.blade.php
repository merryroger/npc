@if($capacity > 0)
    <article>
        <h2>Новостная лента</h2>
        <div class="news__band__control__frame">
            <div class="news__band__ctrls scroll__left" onclick="newsBand.scrollLeft()"></div>
            <div class="news__preview__pad" data-capacity="{!! $capacity !!}" data-visible="{!! $info['visible'] !!}"
                 data-current="{!! $info['current'] !!}" data-first="{!! $info['first'] !!}"
                 data-last="{!! $info['last'] !!}">
                <nav class="news__preview__band" style="--visible-items: {!! $info['visible'] !!}">
                    @foreach($previews as $preview)
                        {!! $preview !!}
                    @endforeach
                </nav>
            </div>
            <div class="news__band__ctrls scroll__right" onclick="newsBand.scrollRight()"></div>
        </div>
    </article>
@endif
