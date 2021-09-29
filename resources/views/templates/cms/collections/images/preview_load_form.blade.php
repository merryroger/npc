<form action="/cms/uploads" class="preview__load__form" enctype="multipart/form-data" method="POST" target="file_upload">
    <fieldset>
        <label>{!! trans('cms.forms.preview_load') !!}</label>
        @csrf
        <input type="hidden" name="uploads" value="preview"/>
        <input type="hidden" name="recId" value="{!! $image['recId'] !!}"/>
        <ul class="preview__selector__set">
            <li class="preview__upload__elem__pad">
                <div class="img_ld_struct">
                    <div class="image__preview__pad non__loaded" data-title="{!! trans('cms.forms.select_photo') !!}" title="{!! trans('cms.forms.select_photo') !!}"></div>
                    <div data-selected="0" class="no__file__selected">
                        <span class="preview__status" data-defstatus="{!! trans('cms.forms.no_file_selected') !!}">{!! trans('cms.forms.no_file_selected') !!}</span>
                        <span class="like__rm__image">✖</span>
                        <span class="upload__ok dk__green h">✔</span>
                        <span class="upload__failed red h">✖</span>
                    </div>
                    <input type="file" name="pwup" class="h" accept="image/jpeg,image/jpg,image/gif,image/png,image/webp" onchange="specifyPreviewImage(this)"/>
                </div>
            </li>
        </ul>
        <section class="form__controls">
            <button type="button" name="close_button"
                    onclick="closePreviewForm(this)">{!! trans('cms.forms.close') !!}</button>
            <button type="button" name="send_button" class="button__disabled"
                    onclick="sendPreviewImage(this)">{!! trans('cms.forms.send') !!}</button>
        </section>
    </fieldset>
</form>
<iframe id="preview_upload" name="file_upload"></iframe>
