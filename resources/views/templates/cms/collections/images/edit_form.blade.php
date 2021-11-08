<form class="image__edit__form">
    <fieldset>
        <label>{!! trans('cms.forms.image_param_edit') !!}</label>
        @csrf
        <div class="image__edit__area">
            <div class="image__edit__pad">
                <h3>{!! trans('cms.forms.original') !!}</h3>
                <div class="image__collection__pad non__loaded"><img loading="lazy" src="/cms/icons?rq={!! base64_encode($image['rel_path'] . $image['origin']) !!}&width=200&height=150" onload="imageViewReady(this)"/></div>
                <div class="image__edit__parameters">
                    <p>{!! trans('cms.forms.image_type') !!}: {!! $image['mime'] !!}</p>
                    <p>{!! trans('cms.forms.image_sizes') !!}: {!! $image[0] !!}x{!! $image[1] !!} px</p>
                </div>
            </div>
            <div class="image__edit__pad preview__location">
                @include('templates/cms/collections/images/preview_presentation', ['image' => $image])
            </div>
        </div>

        <div class="image__location__form">
            <div class="image__edit__area">
                <div class="image__edit__pad required">
                    <h3>{!! trans('cms.forms.image_location') !!}</h3>
                    <select form="edit_location" name="location" size="1" data-def="{!! $image['location'] !!}"
                            data-type="form_field" tabindex="1" onchange="checkLocationDataMismatch(this)">
                        @foreach($locations as $location)
                            @php($selected = (($location['id'] == $image['location']) ? ' selected' : ''))
                            <option value="{!! $location['id'] !!}"{!! $selected !!}>{!! $location['name'] !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="image__edit__pad required">
                    <h3>{!! trans('cms.forms.file_name') !!}</h3>
                    <input form="edit_location" type="text" name="file_name" data-def="{!! md5($image['filename']) !!}"
                           data-type="form_field" value="{!! $image['filename'] !!}" tabindex="2"
                           oninput="checkLocationDataMismatch(this)" required/>
                </div>
            </div>
            <section class="form__controls">
                <button type="reset" form="edit_location" name="reset_button" style="min-width: 25px; width:25px;"
                        class="button__disabled" tabindex="3" title="{!! trans('cms.forms.reset_fields') !!}">↺</button>
                <button type="submit" form="edit_location" name="replace_button" tabindex="4"
                        class="button__disabled">{!! trans('cms.forms.move_rename') !!}</button>
            </section>
        </div>

        <section class="form__controls">
            <button type="button" name="close_button"
                    onclick="closeEditForm(this)">{!! trans('cms.forms.close') !!}</button>
        <!--button type="button" name="send_button" class="button__disabled"
                    onclick="sendImages(this)">{!! trans('cms.forms.send') !!}</button-->
        </section>
    </fieldset>
</form>
<form action="/cms/images" id="edit_location" name="edit_location" data-def="0"
      onreset="return resetImageRelocationForm(this)"
      onsubmit="return submitImageRelocation(this)">
    <input type="hidden" name="opcode" data-type="form_field" value="RIRL"/>
    <input type="hidden" name="recId" data-type="form_field" value="{!! $image['id'] !!}"/>
</form>