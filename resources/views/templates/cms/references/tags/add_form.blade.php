<form action="/cms/tags" class="edit__form" method="POST" onsubmit="return checkFormControls(this)">
    <fieldset>
        <label>{!! trans('cms.forms.resource_tag_create') !!}</label>
        @csrf
        <input type="hidden" name="opcode" data-type="form_field" value="RTAD" />
        <div class="form__field required">
            <label>{!! trans('cms.references.common.name') !!}</label>
            <input type="text" name="name" data-type="form_field" value="" tabindex="1" required autofocus />
        </div>
        <div class="form__field"></div>
        <section class="form__controls">
            <button type="button" name="close_button" tabindex="2"
                    onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
            <button type="submit" name="send_button" tabindex="3">{!! trans('cms.data.create') !!}</button>
        </section>
    </fieldset>
</form>
