@if($group == 'selected')
<div class="news__band__cell" data-newsId="{!! $nid !!}" data-stamp="{!! $stamp !!}" data-neighbours="{!! $neighbours !!}">
@else
<a href="/news?nid={!! $nid !!}" class="news__band__cell" data-newsId="{!! $nid !!}" data-stamp="{!! $stamp !!}" data-neighbours="{!! $neighbours !!}">
@endif
    <div class="news__image"><h6>{!! $date !!}</h6></div>
    <p>{!! $docname !!}.</p>
@if($group == 'selected')
</div>
@else
</a>
@endif
