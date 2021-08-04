<form action="/cms/uploads" class="image__load__form" enctype="multipart/form-data" method="POST" target="file_upload">
    <fieldset>
        <label>{!! trans('cms.forms.image_load') !!}</label>
        @csrf
        <input type="hidden" name="fields" value="fup0"/>
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
                    <input type="file" name="fup0" class="h"
                           accept="image/jpeg,image/jpg,image/gif,image/png,image/webp"
                           onchange="specifyImage(this)"/>
                </div>
            </li>
            <button type="button" name="another_image" title="{!! trans('cms.forms.another_image') !!}">+</button>
        </ul>
        <section class="form__controls">
            <button type="button" name="close_button"
                    onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
            <button type="button" name="send_button" class="button__disabled"
                    onclick="sendImages(this)">{!! trans('cms.forms.send') !!}</button>
        </section>
    </fieldset>
</form>
<iframe id="file_upload" name="file_upload"></iframe>
