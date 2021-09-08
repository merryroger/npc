@foreach($dataset as $idx => $image)
    <div data-id="{!! $image['id'] !!}" class="image__collection__frame">
        <div class="image__collection__item__titlebar">
            <h5>{!! $image['info'] !!}</h5>
            <h5><span class="image__item__controls" onpointerover="showItemControlPanel(this)">≡</span></h5>
        </div>
        <div class="image__collection__pad non__loaded"><img loading="lazy" src="/cms/icons?rq={!! base64_encode($image['origin']) !!}&width=200&height=150" onload="imageViewReady(this)"/></div>
    </div>
@endforeach
