@if($group == 'selected')
<div class="news__band__cell" data-newsId="{!! $nid !!}">
@else
<a href="/news?nid={!! $nid !!}" class="news__band__cell" data-newsId="{!! $nid !!}">
@endif
    {!! $contents !!}
@if($group == 'selected')
</div>
@else
</a>
@endif
