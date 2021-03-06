<form action="/cms/locations" class="edit__form" method="POST" onsubmit="return checkFormControls(this)">
    <fieldset>
        <label>{!! trans('cms.forms.resource_location_create') !!}</label>
        @csrf
        <input type="hidden" name="opcode" data-type="form_field" value="RLAD" />
        <div class="form__field required">
            <label>{!! trans('cms.references.common.name') !!}</label>
            <input type="text" name="name" data-type="form_field" value="" tabindex="1" required autofocus />
        </div>
        <div class="form__field required">
            <label>{!! trans('cms.references.locations.rel_path') !!}</label>
            <div class="form__assembly">
                <input type="text" name="rel_path" data-type="form_field" value="" tabindex="2" required />
                <input type="button" id="location_select_help_button" value="…" tabindex="3" title="{!! trans('cms.menu.file_manager') !!}" />
            </div>
        </div>
        <div class="form__field">
            <div class="form__inline">
                <input type="checkbox" name="use_preview" data-type="form_field" tabindex="4" />
                <label>{!! trans('cms.data.use') !!} {!! trans('cms.data.preview') !!}</label>
            </div>
        </div>
        <div class="form__field"></div>
        <div class="form__field">
            <div class="form__inline">
                <input type="checkbox" name="hidden" data-type="form_field" tabindex="5" />
                <label>{!! trans('cms.data.hide') !!} {!! trans('cms.data.record') !!}</label>
            </div>
        </div>
        <div class="form__field"></div>
        <section class="form__controls">
            <button type="button" name="close_button" tabindex="6"
                    onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
            <button type="submit" name="send_button" tabindex="7">{!! trans('cms.data.create') !!}</button>
        </section>
    </fieldset>
</form>
