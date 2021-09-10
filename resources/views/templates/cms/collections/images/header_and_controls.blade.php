<div class="collection__header">
    <h1>{!! trans('cms.data.imagecollection') !!}</h1>
    <nav id="collection_control_panel">
        <div class="coll__ctrl__btn" title="{!! trans('cms.data.add') !!}" onclick="getImageAddForm(this)">&plus;</div>
        <div class="coll__ctrl__btn" title="{!! trans('cms.data.filter_panel') !!}">Y</div>
    </nav>
</div>
<div id="item_control_panel" class="off" data-id="0">
    <div class="image__item__control__list">
        <a href="/cms/images" onclick="return editImageItem(this)"><span data-level="0">{!! trans('cms.data.edit') !!}</span></a>
        <a href="/cms/images" onclick="return deleteImageItem(this)"><span data-level="0">{!! trans('cms.data.delete') !!}</span></a>
    </div>
</div>
<div id="preview_control_panel" class="off" data-id="0">
    <div class="image__item__control__list">
        <a href="/cms/images" data-type="upload" onclick="return uploadPreview(this)"><span data-level="0">{!! trans('cms.data.upload_from_file') !!}</span></a>
        <a href="/cms/images" data-type="delete" onclick="return deletePreview(this)"><span data-level="0">{!! trans('cms.data.delete') !!}</span></a>
        <p data-type="delete" class="h"><span data-level="0">{!! trans('cms.data.delete') !!}</span></p>
    </div>
</div>

