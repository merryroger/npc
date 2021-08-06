@foreach($dataset as $idx => $image)
    <div class="image__collection__frame">
        <h5>{!! $image['info'] !!}</h5>
        <div loading="lazy" class="image__collection__pad non__loaded"><img src="/cms/icons?rq={!! base64_encode($image['origin']) !!}&width=200&height=150" onload="imageViewReady(this)" /></div>
    </div>
@endforeach
