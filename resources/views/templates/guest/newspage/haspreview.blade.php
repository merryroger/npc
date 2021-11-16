@if($group == 'selected')
<div class="news__band__cell">
@else
<a href="/news?nid={!! $nid !!}" class="news__band__cell">
@endif
    {!! $contents !!}
@if($group == 'selected')
</div>
@else
</a>
@endif
