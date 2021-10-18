<form action="/cms/locations" class="edit__form" method="POST" onsubmit="return checkFormControls(this)">
    <fieldset>
        <label>{!! trans('cms.forms.resource_location_create') !!}</label>
        @csrf


        <section class="form__controls">
            <button type="button" name="close_button"
                    onclick="closeForm(this)">{!! trans('cms.forms.close') !!}</button>
        <!--button type="button" name="send_button" class="button__disabled"
                    onclick="sendImages(this)">{!! trans('cms.forms.send') !!}</button-->
        </section>
    </fieldset>
</form>
