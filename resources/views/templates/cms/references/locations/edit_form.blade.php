<form action="/cms/locations" class="edit__form" method="POST" onsubmit="return checkFormControls(this)">
    <fieldset>
        <label>{!! trans('cms.forms.resource_location_edit') !!}</label>
        @csrf
        <input type="hidden" name="opcode" data-type="form_field" value="RLUD" />
        <input type="hidden" name="itemId" data-type="form_field" value="{!! $dataset['id'] !!}" />
        <div class="form__field required">
            <label>{!! trans('cms.references.common.name') !!}</label>
            <input type="text" name="name" data-type="form_field" value="{!! $dataset['name'] !!}" tabindex="1" required autofocus />
        </div>
        <!--div class="form__field required">
            <label>{!! trans('cms.references.locations.rel_path') !!}</label>
            <div class="form__assembly">
                <input type="text" name="rel_path" data-type="form_field" value="" tabindex="2" required />
                <input type="button" id="location_select_help_button" value="…" tabindex="3" title="{!! trans('cms.menu.file_manager') !!}" />
            </div>
        </div-->
        <div class="form__field">
            <div class="form__inline">
                @php($checked = (($dataset['hidden']) ? ' checked' : ''))
                <input type="checkbox" name="hidden" data-type="form_field"{!! $checked !!} tabindex="4" />
                <label>{!! trans('cms.data.hide') !!}</label>
            </div>
        </div>
        <section class="form__controls">
            <button type="button" name="close_button" tabindex="5"
                    onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
            <!--button type="submit" name="send_button" tabindex="6">{!! trans('cms.forms.send') !!}</button-->
        </section>
    </fieldset>
</form>
