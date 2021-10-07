@foreach($dataset as $idx => $image)
    <!--div data-id="{!! $image['id'] !!}" class="image__collection__frame">
        <div class="image__collection__item__titlebar">
            <h5>{!! $image['info'] !!}</h5>
            <h5><span class="image__item__controls" onpointerover="showItemControlPanel(this)">≡</span></h5>
        </div>
        <div class="image__collection__pad non__loaded"></div>
    </div-->
@endforeach
