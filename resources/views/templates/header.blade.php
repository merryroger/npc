<header>
    <section id="top__frame">
        <aside class="haside haside__left"></aside>
        <section id="title">
            <div class="hdr__holder">
                <h1>Научно-производственный центр</h1>
                <h6>по охране памятников истории и культуры Курганской области</h6>
            </div>
        </section>
        <aside class="haside haside__right">
            <div id="top__controls">
                <form id="search" action="/search">
                    <a href="/auth" class="auth__rq__button" onclick="return callAuth(this, '')" title=""></a>
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
            <a href="/auth" class="auth__rq__button" onclick="return callAuth(this, '2')" title=""></a>
            <a href="/search" class="search__rq__button" onclick="return toggleSearchPanel(this, '2')"
               title="Поиск"></a>
            <input type="text" id="search__text2" name="search__text" value="" class="search__fields sp__hidden"
                   tabindex="1" autofocus/>
            @csrf
        </form>
    </nav>
</header>
