<footer>
    @if($section_ids[0]['id'] == 1)
        <div class="footer__logotype"></div>
    @else
        <a href="/" class="footer__logotype" title="{{ @trans("menu.gohome") }}"></a>
    @endif
    <article class="footer foot__logo">
        <p>НПЦ по&nbsp;охране памятников истории<br/>и&nbsp;культуры Курганской области.</p>
        <ul>Время работы:
            <li>пн—чт, 9:00—18:00;</li>
            <li>пт, 9:00—17:00;</li>
            <li>обеденный перерыв 13:00—13:48.</li>
        </ul>
    </article>
    <article class="footer foot__contacts">
        <p>Адрес: 640020, г.&nbsp;Курган, ул.&nbsp;Советская, д.&nbsp;69.</p>
        <p>Тел./факс: +7&nbsp;(3522)&nbsp;46-02-46, 46-02-08.</p>
        <p>E-mail: <a href="mailto:npckurgan@yandex.ru">npckurgan@yandex.ru</a>.</p>
    </article>
    <article class="footer foot__links">
        @foreach($menu['extra'] as $item)
            @if($item['id'] == $section_ids[0]['id'])
                <p>{{ @trans("menu.$item[mnemo]") }}</p>
            @else
                <a href="{{ $item['url'] }}">{{ @trans("menu.$item[mnemo]") }}</a>
            @endif
        @endforeach
        @if($section_ids[0]['id'] > 1)
            @include('templates/menu/photos', ['menu' => $menu['collections']])
            @include('templates/menu/videos', ['menu' => $menu['collections']])
            <a href="/">{{ @trans("menu.gohome") }}</a>
        @endif
    </article>
</footer>
