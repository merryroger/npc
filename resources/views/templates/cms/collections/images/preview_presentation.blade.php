@php($isPreview = (isset($image['preview'])) ? 1 : 0)
<div class="image__preview__titlebar">
    <h3>{!! trans('cms.forms.preview') !!}</h3>
    <h3><span class="image__item__controls" data-ispreview="{!! $isPreview !!}" onpointerover="showPreviewControlPanel(this, {!! $image['id'] !!})">≡</span></h3>
</div>
@if($isPreview)
    <div class="image__preview__pad non__loaded"><img src="/cms/icons?rq={!! base64_encode($image['preview_info']['origin']) !!}&width=100&height=75&v={!! time() !!}" onload="previewReady(this)"/></div>
    <div class="image__edit__parameters">
        <p>{!! trans('cms.forms.image_type') !!}: {!! $image['preview_info']['mime'] !!}</p>
        <p>{!! trans('cms.forms.image_sizes') !!}: {!! $image['preview_info'][0] !!}x{!! $image['preview_info'][1] !!} px</p>
    </div>
@else
    <div class="image__preview__pad non__loaded"></div>
    <div class="image__edit__parameters">
        <p>{!! trans('cms.forms.image_not_loaded') !!}</p>
    </div>
@endif
