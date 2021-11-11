@foreach($menu['main'] as $item)
    @if($item['id'] == $section_ids[0]['id'])
        <p>{{ @trans("menu.$item[mnemo]") }}</p>
    @else
        <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
    @endif
@endforeach
<div class="extra__menu">
    @foreach($menu['extra'] as $item)
        @if($item['id'] == $section_ids[0]['id'])
            @php($cls = (count($section_ids) > 1) ? '' : ' class="def__pointer"')
            <p{!! $cls !!}>{{ @trans("menu.$item[mnemo]") }}</p>
        @else
            <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
        @endif
    @endforeach
    @if($section_ids[0]['id'] > 1)
        <a href="/">{{ @trans("menu.gohome") }}</a>
    @endif
</div>
<div class="sublevels__menu">
@foreach($menu['submenu'] as $item)
    <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}" data-parent="{{ $item['parent'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
@endforeach
</div>
