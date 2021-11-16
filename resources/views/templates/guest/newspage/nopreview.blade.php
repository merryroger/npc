@if($group == 'selected')
<div class="news__band__cell">
@else
<a href="/news?nid={!! $nid !!}" class="news__band__cell">
@endif
    <div class="news__image"><h6>{!! $date !!}</h6></div>
    <p>{!! $docname !!}.</p>
@if($group == 'selected')
</div>
@else
</a>
@endif
