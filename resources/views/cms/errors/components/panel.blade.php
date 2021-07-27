<div id="error_panel">
    <div class="error__panel__header">
        <h2>{!! $type !!}</h2>
    </div>
    <form id="error_form" class="error__form">
        <section class="error__description">
            <p>{!! $description !!}</p>
        </section>
        <section class="error__controls">
            <button type="button" onclick="doAction(this, (fm) => { hideError(); })">Ok</button>
        </section>
    </form>
</div>
