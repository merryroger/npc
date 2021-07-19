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
                <p onpointerover="showCMSMenu(this, 0)">CMS</p>
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
<div id="cmm_pad" data-level="0" class="off">
{!! serialize($menu_collection) !!}
</div>
<div id="ucp_pad" data-level="0" class="off">
    <a href="/logout">Выйти</a>
</div>
