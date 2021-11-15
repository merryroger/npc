<article>
    @if($capacity == 0)
        <h2>Новости</h2>
        <div class="empty__line">Нет сообщений</div>
    @else
        {!! $message !!}
    @endif
</article>
