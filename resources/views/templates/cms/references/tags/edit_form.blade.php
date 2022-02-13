<form action="/cms/tags" class="edit__form" method="POST" onsubmit="return checkFormControls(this)">
    <fieldset>
        <label>{!! trans('cms.forms.resource_tag_edit') !!}</label>
        @csrf
        <input type="hidden" name="opcode" data-type="form_field" value="RTUD" />
        <input type="hidden" name="itemId" data-type="form_field" value="{!! $dataset['id'] !!}" />
        <div class="form__field required">
            <label>{!! trans('cms.references.common.name') !!}</label>
            <input type="text" name="name" data-type="form_field" value="{!! $dataset['name'] !!}" tabindex="1" required autofocus />
        </div>
        <section class="form__controls">
            <button type="button" name="close_button" tabindex="2"
                    onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
            <button type="submit" name="send_button" tabindex="3">{!! trans('cms.data.save') !!}</button>
        </section>
    </fieldset>
</form>
