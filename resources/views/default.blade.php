<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>НПЦ по охране памятников истории и культуры Курганской области</title>
    <link href="/favicon.ico" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <style>
        @include('styles/fonts')
        @include('styles/media/over_1920')
        @include('styles/media/between_1200_1920')
        @include('styles/media/between_890_1199')
        @include('styles/media/less_890')
        @include('styles/default')
        @include('styles/substyles/news_aside')
    </style>
    <script src="/js/common.js" type="text/javascript"></script>
    <script src="/js/mainmenu.js" type="text/javascript"></script>
    <script src="/js/search.js" type="text/javascript"></script>
</head>
<body>
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
                    <a href="/search" class="search__rq__button" onclick="return toggleSearchPanel(this, '')"
                       title="Поиск"></a>
                    <input type="text" id="search__text" name="search__text" value="" class="search__fields sp__hidden"
                           tabindex="1" autofocus/>
                </form>
            </div>
        </aside>
    </section>
    <nav class="mainmenu">
        <a href="/" data-item="1" data-node="1" data-level="0">Деятельность</a>
        <a href="/" data-item="2" data-node="2" data-level="0">Архитектура</a>
        <a href="/" data-item="3" data-node="3" data-level="0">Археология</a>
        <a href="/" data-item="4" data-node="4" data-level="0">Контактная информация</a>
        <div class="extra__menu">
            <a href="/" data-item="5" data-node="5" data-level="0">Противодействие коррупции</a>
            <a href="/" data-item="6" data-node="6" data-level="0">О центре</a>
            <a href="/" data-item="7" data-node="7" data-level="0">Новости</a>
        </div>
        <div class="sublevels__menu">
            <a href="/" data-item="10" data-node="1" data-level="1" data-parent="1">Документы</a>
            <a href="/" data-item="11" data-node="1" data-level="1" data-parent="1">Публикации</a>
            <a href="/" data-item="12" data-node="1" data-level="1" data-parent="1">История НПЦ</a>
            <a href="/" data-item="13" data-node="2" data-level="1" data-parent="2">Здания</a>
            <a href="/" data-item="14" data-node="2" data-level="1" data-parent="2">Реставрация</a>
            <a href="/" data-item="15" data-node="2" data-level="1" data-parent="2">Храмы</a>
            <a href="/" data-item="16" data-node="3" data-level="1" data-parent="3">Отдел археологии НПЦ</a>
            <a href="/" data-item="17" data-node="3" data-level="1" data-parent="3">История исследований</a>
        </div>
    </nav>
    <nav class="sq__ctrls">
        <div class="sq__mmnu" title="Меню" onclick="return call_root_menu(this)"></div>
        <form id="search2" action="/search">
            <a href="/search" class="search__rq__button" onclick="return toggleSearchPanel(this, '2')"
               title="Поиск"></a>
            <input type="text" id="search__text2" name="search__text" value="" class="search__fields sp__hidden"
                   tabindex="1" autofocus/>
        </form>
    </nav>
</header>
<section id="mainpad">
    <aside class="page__aside aside__left">

    </aside>
    <section class="main__sheet">
        @yield('contents')
        <article>
            <h2>О центре</h2>
            <p>ГКУ «Научно-производственный центр по охране и использованию объектов культурного наследия (памятников
                истории и культуры) Курганской области» является производственной структурой в области охраны объектов
                культурного наследия.</p>
            <p>Основные виды деятельности: обследование, изучение и документирование объектов культурного наследия.</p>
            <p>ГКУ НПЦ проводит историко-архивные, научно-исследовательские, проектно-изыскательские работы, готовит
                акты технического состояния, определяет границы охраняемого объекта, осуществляет надзор за
                ремонтно-реставрационными работами.</p>
            <p>В штате ГКУ НПЦ имеются специалисты по архитектуре и строительству, археологии, гео-информационным
                системам.</p>
        </article>
        <section class="zwei__spalte">
            <article class="photo__collection">
                <h2>Фотографии</h2>
                <a href="/" class="centered">
                    <div class="photos graphic__contents"></div>
                </a>
            </article>
            <article class="photo__collection">
                <h2>Видео</h2>
                <a href="/" class="centered">
                    <div class="videos graphic__contents"></div>
                </a>
            </article>
        </section>
    </section>
    <aside class="page__aside aside__right">
        <section id="news">
            <h2>Новости</h2>
            <div class="list__container">
                <a href="/" class="news">
                    <div class="news__image"><h6>21.05.2021</h6><img src="/images/news/preview/savin.jpg"
                                                                     alt="На Савин"/></div>
                    <p>Мастер-классы по чеканке монет, стрельбе из лука, народные игры – гостей первого этнофестиваля
                        «Едем на Савин» ждёт настоящий исторический праздник.</p>
                </a>
                <a href="/" class="news">
                    <div class="news__image"><h6>17.05.2021</h6><img src="/images/news/preview/savin-1.jpg"
                                                                     alt="На Савин"/></div>
                    <p>Святилище «Савин» заинтересовало российских туроператоров.</p>
                </a>
                <a href="/" class="news">
                    <div class="news__image"><h6>29.04.2021</h6><img src="/images/news/preview/pamyatnik.jpg"
                                                                     alt="Памятник погибшим в Великой Отечественной войне"/>
                    </div>
                    <p>Губернатор Вадим Шумков вместе со школьниками привёл в порядок памятник погибшим в Великой
                        Отечественной войне.</p>
                </a>
                <a href="/" class="news extra__news">
                    <div class="news__image"><h6>24.04.2021</h6><img src="/images/news/preview/sad_pamyati.jpg"
                                                                     alt="Сад памяти"/></div>
                    <p>Рядом с Курганом посадили деревья в память о погибших в годы Великой Отечественной войны</p>
                </a>
            </div>
            <a href="/" class="all__news">Все новости</a>
        </section>
    </aside>
</section>
<footer>
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
        <a href="/">Противодействие коррупции</a>
        <a href="/">О центре</a>
        <a href="/">Новости</a>
    </article>
</footer>
</body>
</html>