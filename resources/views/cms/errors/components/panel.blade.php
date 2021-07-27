<div id="error_panel">
    <div class="error__panel__header">
        <h2>{!! trans("cms.errors.{$errorSet['type']}") !!} {!! $errorSet['errorcode'] !!}</h2>
    </div>
    <form id="error_form" class="error__form">
        <section class="error__description">
            <p>{!! $errorSet['description'] !!}</p>
        </section>
        {!! $errorSet['controls'] !!}
    </form>
</div>
