<form action="/cms/images" class="image__edit__form" enctype="multipart/form-data" method="POST" target="file_upload">
    <fieldset>
        <label>{!! trans('cms.forms.image_param_edit') !!}</label>
        @csrf
        <div class="image__edit__area">
            <div class="image__edit__pad">
                <h3>{!! trans('cms.forms.original') !!}</h3>
                <div class="image__collection__pad non__loaded"><img loading="lazy" src="/cms/icons?rq={!! base64_encode($image['origin']) !!}&width=200&height=150" onload="imageViewReady(this)"/></div>
                <div class="image__edit__parameters">
                    <p>{!! trans('cms.forms.image_type') !!}: {!! $image['mime'] !!}</p>
                    <p>{!! trans('cms.forms.image_sizes') !!}: {!! $image[0] !!}x{!! $image[1] !!} px</p>
                </div>
            </div>
            <div class="image__edit__pad preview__location">
                @include('templates/cms/collections/images/preview_presentation', ['image' => $image])
            </div>
        </div>
        <div class="image__edit__pad">
            <h3>{!! trans('cms.forms.image_location') !!}</h3>
        </div>

        <section class="form__controls">
            <button type="button" name="close_button"
                    onclick="closeEditForm(this)">{!! trans('cms.forms.close') !!}</button>
        <!--button type="button" name="send_button" class="button__disabled"
                    onclick="sendImages(this)">{!! trans('cms.forms.send') !!}</button-->
        </section>
    </fieldset>
</form>
