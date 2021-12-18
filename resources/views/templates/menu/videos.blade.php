@php($item = $menu[10])
@if($item['id'] == $section_ids[0]['id'])
    @php($cls = (count($section_ids) > 1) ? '' : ' class="def__pointer"')
    <p{!! $cls !!}>{{ @trans("menu.$item[mnemo]") }}</p>
@else
    <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
@endif
