@if ($total > 0)
    <section class="data__list">
        !!!!!!
    </section>
@else
    <section class="data__list__empty">
        <h1>{!! trans('cms.data.photocollection') !!}</h1>
        <h3>{!! trans('cms.data.no_data') !!}</h3>
    </section>
@endif

