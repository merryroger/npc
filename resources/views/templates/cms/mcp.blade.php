<div id="mcp_pad" class="pushed">
    <div id="mcp_pan">
        <nav class="cms__mmnu">
            <a href="/">Сайт</a>
            <a href="/cms">CMS</a>
        </nav>
        <div class="mcp__ctrls">
            <p onclick="showUserControlPanel(this)">{!! $user['name'] !!}</p>
        </div>
    </div>
    <div id="mcp_tng">
        <div class="tongue" onclick="return mcpToggle(this)"><p class="pushed">︽</p></div>
    </div>
</div>
<div id="ucp_pad" class="off">
    <a href="/logout">Выйти</a>
</div>
