@if ($total > 0)
    <section class="data__list">
        @include('templates.cms.collections.images.header_and_controls')
    </section>
@else
    <section class="data__list__empty">
        @include('templates.cms.collections.images.header_and_controls')
        <h3>{!! trans('cms.data.no_data') !!}</h3>
    </section>
@endif
