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
        <p>E-mail: <a href="mailto:npc45ru@yandex.ru">npc45ru@yandex.ru</a>.</p>
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
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(89141211, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/89141211" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</footer>
