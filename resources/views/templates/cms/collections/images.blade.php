@if ($total > 0)
    <section class="data__list">
        !!!!!!
    </section>
@else
    <section class="data__list__empty">
        <div class="collection__header">
            <h1>{!! trans('cms.data.imagecollection') !!}</h1>
            <nav id="collection_control_panel">
                <div class="coll__ctrl__btn" title="{!! trans('cms.data.add') !!}" onclick="getImageAddForm(this)">&plus;</div>
                <div class="coll__ctrl__btn" title="{!! trans('cms.data.filter_panel') !!}">Y</div>
            </nav>
        </div>
        <h3>{!! trans('cms.data.no_data') !!}</h3>
    </section>
@endif
