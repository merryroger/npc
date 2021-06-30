@foreach($menu['main'] as $item)
    <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
@endforeach
<div class="extra__menu">
    @foreach($menu['extra'] as $item)
        <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
    @endforeach
</div>
<div class="sublevels__menu">
@foreach($menu['submenu'] as $item)
    <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}" data-parent="{{ $item['parent'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
@endforeach
</div>
