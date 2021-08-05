@if ($total > 0)
    <section class="data__list">
        @include('templates.cms.collections.images.header_and_controls')
        <nav class="collection__list__controls">R</nav>
        <section class="page__band">D</section>
    </section>
@else
    <section class="data__list__empty">
        @include('templates.cms.collections.images.header_and_controls')
        <h3>{!! trans('cms.data.no_data') !!}</h3>
    </section>
@endif
