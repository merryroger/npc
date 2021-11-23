<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopeUndeleted($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeValid($query, $include_hidden = false)
    {
        $query = $this->scopeUndeleted($query);

        return ($include_hidden) ? $query : $query->where('hidden', 0);
    }

    public function scopeNewsCount($query, $include_hidden = false)
    {
        $query = $this->scopeUndeleted($query);

        return ($include_hidden) ? $query->count() : $query->where('hidden', 0)->count();
    }

    public function scopeNewsItem($query, $id, $show_hidden = false)
    {
        return $this->scopeValid($query, $show_hidden)->whereId($id)->first();
    }

    public function scopeNewsList($query, $count, $order, $include_hidden = false)
    {
        return $this->scopeValid($query, $include_hidden)->orderBy('official_news_date', $order)->skip(0)->take($count);
    }

    public function scopeNewsListById($query, $ids, $order, $include_hidden = false)
    {
        $whereIDS = '(id = ' . join(' OR id = ', $ids) . ')';

        return $this->scopeValid($query, $include_hidden)->whereRaw($whereIDS)->orderBy('official_news_date', $order);
    }

    public function scopeMaxNewsItemByOfficialDate($query, $include_hidden = false)
    {
        return $this->scopeValid($query, $include_hidden)->orderBy('official_news_date', 'desc')->first();
    }

    public function scopeNeighboursInfo($query, $newsId)
    {
        $result = [];
        $item = $this->scopeNewsItem($query, $newsId);

        $result['after'] = $this->scopeValid($this::query())->where('official_news_date', '>', $item->official_news_date)->count();
        $result['before'] = $this->scopeValid($this::query())->where('official_news_date', '<', $item->official_news_date)->count();

        $result['last'] = $this->scopeValid($this::query())->orderBy('official_news_date', 'desc')->first()->id;
        $result['first'] = $this->scopeValid($this::query())->orderBy('official_news_date', 'asc')->first()->id;

        return $result;
    }

    public function scopeNewsSurroundIds($query, $newsId, &$info)
    {
        $result = [];
        $item = $this->scopeNewsItem($query, $newsId);

        $result['after'] = $this->scopeValid($this::query())
            ->where('official_news_date', '>', $item->official_news_date)
            ->orderBy('official_news_date', 'asc')
            ->skip(0)->take($info['take_after'])->pluck('id')->all();
        $result['selected'] = [$item->id];
        $result['before'] = $this->scopeValid($this::query())
            ->where('official_news_date', '<', $item->official_news_date)
            ->orderBy('official_news_date', 'desc')
            ->skip(0)->take($info['take_before'])->pluck('id')->all();

        return $result;
    }

}
