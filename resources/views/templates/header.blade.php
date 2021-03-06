<header>
    <section id="top__frame">
        <aside class="haside haside__left"></aside>
        @if($section_ids[0]['id'] > 1)
            <a href="/" id="title" title="{!! trans('menu.gohome') !!}">
        @else
            <section id="title">
        @endif
            <div class="hdr__holder">
                <h1>Научно-производственный центр</h1>
                <h6>по охране памятников истории и культуры Курганской области</h6>
            </div>
        @if($section_ids[0]['id'] > 1)
            </a>
        @else
            </section>
        @endif
        <aside class="haside haside__right">
            <div id="top__controls">
                <form id="search" action="/search">
                    @if ($user)
                    @else
                        <a href="/auth" class="auth__rq__button" onclick="return callAuth(this, '')" title=""></a>
                    @endif
                    <a href="/search" class="search__rq__button" onclick="return toggleSearchPanel(this, '')"
                       title="Поиск"></a>
                    <input type="text" id="search__text" name="search__text" value="" class="search__fields sp__hidden"
                           tabindex="1" autofocus/>
                    @csrf
                </form>
            </div>
        </aside>
    </section>
    <nav class="mainmenu">
        @include('templates/menu/main', ['menu' => $menu])
    </nav>
    <nav class="sq__ctrls">
        <div class="sq__mmnu" title="Меню" onclick="return call_root_menu(this)"></div>
        <form id="search2" action="/search">
            @if ($user)
            @else
                <a href="/auth" class="auth__rq__button" onclick="return callAuth(this, '2')" title=""></a>
            @endif
            <a href="/search" class="search__rq__button" onclick="return toggleSearchPanel(this, '2')"
               title="Поиск"></a>
            <input type="text" id="search__text2" name="search__text" value="" class="search__fields sp__hidden"
                   tabindex="1" autofocus/>
            @csrf
        </form>
    </nav>
    @if ($user)
        @include('templates/cms/mcp', ['user' => $user])
    @endif
</header>
