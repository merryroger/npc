<form class="image__load__form">
<fieldset>
    <label>{!! trans('cms.forms.image_load') !!}</label>
    <input type="file" name="fup" class="h" onchange="specifyImage(this)" />
    <ol class="image__selector__set">
        <li data-id="1" class="image__upload__elem__pad"></li>
        <button type="button">+</button>
    </ol>
    <section class="form__controls">
        <button type="button" onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
    </section>
</fieldset>
</form>
