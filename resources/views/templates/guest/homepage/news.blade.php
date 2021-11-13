<section id="news">
    <h2>Новости</h2>
    @if($capacity == 0)
        <div class="empty__line">Нет сообщений</div>
    @else
        <div class="list__container">

        </div>
        <a href="/news" class="all__news">Все новости</a>
    @endif
</section>
