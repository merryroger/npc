<form action="/cms/locations" class="edit__form" method="POST" onsubmit="return checkFormControls(this)">
    <fieldset>
        <label>{!! trans('cms.forms.resource_location_create') !!}</label>
        @csrf
        <div class="form__field">
            <label>{!! trans('cms.references.common.name') !!}</label>
            <input type="text" name="name" value="" tabindex="1" required autofocus />
        </div>
        <div class="form__field">
            <label>{!! trans('cms.references.locations.location') !!}</label>
            <div class="form__assembly">
                <input type="text" name="location" value="" tabindex="2" required />
                <input type="button" id="location_select_help_button" value="..." tabindex="3" title="{!! trans('cms.menu.file_manager') !!}" />
            </div>
        </div>

        <section class="form__controls">
            <button type="button" name="close_button"
                    onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
        <!--button type="button" name="send_button" class="button__disabled"
                    onclick="sendImages(this)">{!! trans('cms.forms.send') !!}</button-->
        </section>
    </fieldset>
</form>
