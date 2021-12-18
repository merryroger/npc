@foreach($menu['main'] as $item)
    @if($item['id'] == $section_ids[0]['id'] && count($section_ids) == 1)
        @if (isset($menu_tree[$item['node']][$item['level'] + 1]))
            <p class="menu__node" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}">{{ @trans("menu.$item[mnemo]") }}</p>
        @else
            <p>{{ @trans("menu.$item[mnemo]") }}</p>
        @endif
    @elseif($item['id'] == $section_ids[0]['id'] && count($section_ids) > 1)
        <a class="menu__node" href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
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
        @include('templates/menu/photos', ['menu' => $menu['collections']])
        @include('templates/menu/videos', ['menu' => $menu['collections']])
        <a href="/">{{ @trans("menu.gohome") }}</a>
    @endif
</div>
<div class="sublevels__menu">
@foreach($menu['submenu'] as $item)
   @if(count($section_ids) > $item['level'] && $item['id'] == $section_ids[$item['level']]['id'])
        <p class="menu__node" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}" data-parent="{{ $item['parent'] }}">{{ @trans("menu.$item[mnemo]") }}</p>
   @else
        <a href="{{ $item['url'] }}" data-item="{{ $item['id'] }}" data-node="{{ $item['node'] }}" data-level="{{ $item['level'] }}" data-parent="{{ $item['parent'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
   @endif
@endforeach
</div>
