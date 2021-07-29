<form class="image__load__form">
    <fieldset>
        <label>{!! trans('cms.forms.image_load') !!}</label>
        <div id="img_ld_struct" class="h">
            <div class="img__ld__pad no__photo"></div>
            <div data-selected="0" class="no__file__selected">
                <span class="img__status">{!! trans('cms.forms.no_file_selected') !!}</span>
                <span class="rm__image red" onclick="clearImage(this)">✖</span>
            </div>
        </div>
        <input type="file" name="fup" class="h" accept="image/jpeg,image/jpg,image/gif,image/png" onchange="specifyImage(this)"/>
        <ul class="image__selector__set">
            <li data-id="1" class="image__upload__elem__pad">
                <div class="img_ld_struct">
                    <div class="img__ld__pad no__photo"></div>
                    <div data-selected="0" class="no__file__selected">
                        <span class="img__status">{!! trans('cms.forms.no_file_selected') !!}</span>
                        <span class="rm__image red" onclick="return clearImage(this)">✖</span>
                    </div>
                </div>
            </li>
            <button type="button" name="another_image" title="{!! trans('cms.forms.another_image') !!}">+</button>
        </ul>
        <section class="form__controls">
            <button type="button" onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
        </section>
    </fieldset>
</form>
