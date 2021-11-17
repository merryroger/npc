<?php
/**
 * Created by Ehwaz Raido.
 * Date: 05.07.2021
 */

namespace ehwas\news;

use App\Models\Event;

class NewslineReader
{

    const NEWSLIST_PREVIEW_COUNT = 3;
    const NEWSLIST_PREVIEW_ORDER = 'desc';

    const NEWS_ORIGIN = '/../resources/documents/news';

    public function __construct()
    {
    }

    public function load($doc_path = '', $base_dir = __DIR__, $page = 1, $xslt = []): void
    {
    }

    public function getNewsCount()
    {
        return Event::newsCount();
    }

    protected function retrievePreviewData($data)
    {
        $newspath = realpath(app_path() . $this::NEWS_ORIGIN);

        return $data->get()->map(function ($item, $key) use ($newspath) {
            $item->source = realpath($newspath . '/' . $item->source);
            if (isset($item->preview)) {
                $item->preview = realpath($newspath . '/preview/' . $item->preview);
            }

            return collect($item)->except(['collection_id', 'hidden', 'created_at', 'updated_at', 'deleted_at'])->all();
        })->all();
    }

    public function pickPreviewList(&$settings)
    {
        $count = (isset($settings['count']) && $settings['count']) ? $settings['count'] : $this::NEWSLIST_PREVIEW_COUNT;
        $order = (isset($settings['order']) && !strcasecmp($settings['order'], 'asc')) ? 'asc' : $this::NEWSLIST_PREVIEW_ORDER;

        return $this->retrievePreviewData(Event::newsList($count, $order));
    }

    public function getLastNewsId()
    {
        $item = Event::maxNewsItemByOfficialDate();

        return ($item->count()) ? $item->id : 0;
    }

    public function pickPreviewSurroundList($newsId, &$settings, &$info)
    {
        $result = [];
        $order = (isset($settings['order']) && !strcasecmp($settings['order'], 'asc')) ? 'asc' : $this::NEWSLIST_PREVIEW_ORDER;

        $info = $info + Event::neighboursInfo($newsId); //dump($settings);
        //if ($info['capacity'] < $settings['after'] + $settings['before']) {
            $info['take_after'] = ($info['after'] < $settings['after']) ? $info['after'] : $settings['after'];
            //$da = $settings['after'] - $info['take_after'];
            $info['take_before'] = ($info['before'] < $settings['before']) ? $info['before'] : $settings['before'];
        //} else {

        //}

        $item_ids = Event::newsSurroundIds($newsId, $info);
        foreach ($item_ids as $group => $ids) {
            if (!$ids) {
                $result[$group] = [];
                continue;
            }

            $result[$group] = $this->retrievePreviewData(Event::newsListById($ids, $order));
        }

        return $result;
    }

    public function getItem($newsId, $show_hidden = false)
    {
        $newspath = realpath(app_path() . $this::NEWS_ORIGIN);

        $newsItem = Event::newsItem($newsId, $show_hidden);
        if ($newsItem->count()) {
            return collect($newsItem)->reduce(function ($carry, $item, $key) use ($newspath) {
                switch ($key) {
                    case 'id':
                    case 'official_news_date':
                    case 'collection_id':
                        $carry[$key] = $item;
                        break;
                    case 'source':
                        $carry[$key] = realpath($newspath . '/' . $item);
                        break;
                    default:
                }

                return $carry;
            }, []);
        } else {
            return [];
        }
    }

    public function getContents()
    {
        return '';
    }

    public function __destruct()
    {
    }

}
