@foreach($dataset as $idx => $image)
    <div class="image__collection__frame">
        <h5>{!! $image['info'] !!}</h5>
        <div class="image__collection__pad"><img src="/cms/icons?rq={!! base64_encode($image['origin']) !!}" /></div>
    </div>
@endforeach
