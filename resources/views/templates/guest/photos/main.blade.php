<article>
    <h2>Фотогалерея</h2>
    @if($capacity != 0/************* Temporary condition ****************/)
        <div class="empty__line">Галерея пуста</div>
    @else
        <nav class="photo__pad">
            <div class="photo__item__pad">
                <a style="background-image: url('/images/temp/Kurgan.Kujbysheva.122.Dom.Kuptsov.Smolinykh.jpg')"></a>
                <p>Г.&nbsp;Курган, ул.&nbsp;Куйбышева,&nbsp;122, дом купцов Смолиных</p>
            </div>
            <div class="photo__item__pad">
                <a style="background-image: url('/images/temp/Shadrinsk.K_Libknekhta.3.Zdanie.realnogo.uchilishcha.jpg')"></a>
                <p>Г.&nbsp;Шадринск, ул.&nbsp;К.&nbsp;Либкнехта,&nbsp;3, здание Реального училища</p>
            </div>
            <div class="photo__item__pad">
                <a style="background-image: url('/images/temp/Shadrinsk.Stepana_Razina.38.Veranda.usadby.Averkieva.jpg')"></a>
                <p>Г.&nbsp;Шадринск, ул.&nbsp;Степана&nbsp;Разина,&nbsp;38, веранда усадьбы Аверкиева</p>
            </div>
            <div class="photo__item__pad empty"></div>
        </nav>
    @endif
</article>
