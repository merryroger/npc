@php($isPreview = (isset($image['preview'])) ? 1 : 0)
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
            <div class="image__edit__pad">
                <div class="image__preview__titlebar">
                    <h3>{!! trans('cms.forms.preview') !!}</h3>
                    <h3><span class="image__item__controls" data-ispreview="{!! $isPreview !!}" onpointerover="showPreviewControlPanel(this, {!! $image['id'] !!})">≡</span></h3>
                </div>
                @if($isPreview)
                @else
                    <div class="image__preview__pad non__loaded"></div>
                    <div class="image__edit__parameters">
                        <p>{!! trans('cms.forms.image_not_loaded') !!}</p>
                    </div>
                @endif
            </div>
        </div>
        <!--input type="file" name="fpv" class="h" accept="image/jpeg,image/jpg,image/gif,image/png,image/webp" onchange="redrawPreview(this)" /-->
    <!--input type="hidden" name="fields" value="fup0"/>
        <input type="hidden" name="pack_id" value="{!! md5(now()) !!}"/>
        <div id="img_ld_struct" class="h">
            <div class="img__ld__pad no__photo" title="{!! trans('cms.forms.select_photo') !!}"></div>
            <div data-selected="0" class="no__file__selected">
                <span class="img__status">{!! trans('cms.forms.no_file_selected') !!}</span>
                <span class="rm__image red" onclick="clearImage(this)">✖</span>
                <span class="upload__ok dk__green h">✔</span>
                <span class="upload__failed red h">✖</span>
            </div>
        </div>
        <ul class="image__selector__set">
            <li class="image__upload__elem__pad">
                <div class="img_ld_struct">
                    <div class="img__ld__pad no__photo" title="{!! trans('cms.forms.select_photo') !!}"></div>
                    <div data-selected="0" class="no__file__selected">
                        <span class="img__status">{!! trans('cms.forms.no_file_selected') !!}</span>
                        <span class="rm__image red" onclick="return clearImage(this)">✖</span>
                        <span class="upload__ok dk__green h">✔</span>
                        <span class="upload__failed red h">✖</span>
                    </div>

                </div>
            </li>
            <button type="button" name="another_image" title="{!! trans('cms.forms.another_image') !!}">+</button>
        </ul-->
        <section class="form__controls">
            <button type="button" name="close_button"
                    onclick="closeEditForm(this)">{!! trans('cms.forms.close') !!}</button>
        <!--button type="button" name="send_button" class="button__disabled"
                    onclick="sendImages(this)">{!! trans('cms.forms.send') !!}</button-->
        </section>
    </fieldset>
</form>
<!--iframe id="file_upload" name="file_upload"></iframe-->
