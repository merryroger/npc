@if($group == 'selected')
<div class="news__band__cell" data-newsId="{!! $nid !!}" data-stamp="{!! $stamp !!}" data-neighbours="{!! $neighbours !!}">
@else
<a href="/news?nid={!! $nid !!}" class="news__band__cell" data-newsId="{!! $nid !!}" data-stamp="{!! $stamp !!}" data-neighbours="{!! $neighbours !!}" onclick="return newsBand.loadNews({!! $nid !!})">
@endif
@include('templates.guest.newspage.preview_from_docname')
@if($group == 'selected')
</div>
@else
</a>
@endif
