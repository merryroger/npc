@extends($view)

@section('styles')
    @include('styles/substyles/news_aside')
@endsection

@section('left_aside')
    <aside class="page__aside aside__left">
        {!! $contents['left_aside'] !!}
    </aside>
@endsection

@section('main_sheet')
    <section class="main__sheet">
        {!! $contents['main_sheet'] !!}
    </section>
@endsection

@section('right_aside')
    <aside class="page__aside aside__right">
        {!! $contents['right_aside'] !!}
<!--
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
        <a href="/news" class="all__news">Все новости</a>
        //-->
    </aside>
@endsection

@section('banners')
@endsection
