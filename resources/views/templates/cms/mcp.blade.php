<div id="mcp_pad" class="pushed">
    <div id="mcp_pan">
        <nav class="cms__mmnu">
            @php
                $route = \Illuminate\Support\Facades\Route::current()->getName();
            @endphp
            @if ($route == 'guest.lvl1.sections')
                <p>Сайт</p>
                <a href="/cms">CMS</a>
            @else
                <a href="/">Сайт</a>
                <p onpointerover="showCMSMenu(this, 0, 'main')">CMS</p>
            @endif
        </nav>
        <div class="mcp__ctrls">
            <p onclick="showUserControlPanel(this)">{!! $user['name'] !!}</p>
        </div>
    </div>
    <div id="mcp_tng">
        <div class="tongue" onclick="return mcpToggle(this)"><p class="pushed">︽</p></div>
    </div>
</div>
<div id="cmm_main" data-level="0" class="off">
    @php($mmain = $menu['main'])
    @foreach($mmain as $id => $mdata)
        @switch ($mdata['behaviour'])
            @case('folder')
            <a href="/" onclick="return false" onpointerover="return {!! $mdata['url'] !!}">
                {!! @trans("cms.menu.{$mdata['mnemo']}") !!}
            </a>
            @break
            @default
            <a href="{!! $mdata['url'] !!}" onclick="return followLink('{!! $mdata['url'] !!}')">{!! $mdata['mnemo'] !!}</a>
        @endswitch
    @endforeach
</div>
<div id="ucp_pad" data-level="0" class="off">
    <a href="/logout">Выйти</a>
</div>
