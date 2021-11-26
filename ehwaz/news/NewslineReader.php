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

    protected function neighbourFilter($data)
    {
        $result = [];

        foreach ($data as $group => $dataset) {
            $result[$group] = $dataset->reduce(function ($carry, $item) {
                $carry[] = [$item->official_news_date => $item->id];
                return $carry;
            }, []);
        }

        krsort($result['after']);

        return $result;
    }

    protected function retrievePreviewData($data, $visible_count)
    {
        $neighbors_cnt = $visible_count - 1;
        $newspath = realpath(app_path() . $this::NEWS_ORIGIN);

        return $data->get()->map(function ($item, $key) use ($newspath, $neighbors_cnt) {
            $item->source = realpath($newspath . '/' . $item->source);

            $item->neighbours = $this->neighbourFilter(Event::neighboursIds($item->id, $neighbors_cnt));

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

        if ($info['capacity'] < $settings['after'] + $settings['before']) {
            $info['take_after'] = ($info['after'] < $settings['after']) ? $info['after'] : $settings['after'];
            $settings['before'] += $settings['after'] - $info['take_after'];
            $info['take_before'] = ($info['before'] < $settings['before']) ? $info['before'] : $settings['before'];
        } else {
            $da = $settings['after'] - $info['after'];
            $db = $settings['before'] - $info['before'];
            if ($da >= 0) {
                $info['take_after'] = $info['after'];
                $info['take_before'] = $settings['before'] + $da;
            } elseif ($db >= 0) {
                $info['take_before'] = $info['before'];
                $info['take_after'] = $settings['after'] + $db;
            } else {
                $info['take_after'] = $settings['after'];
                $info['take_before'] = $settings['before'];
            }
        }

        $item_ids = Event::newsSurroundIds($newsId, $info);

        foreach ($item_ids as $group => $ids) {
            if (!$ids) {
                $result[$group] = [];
                continue;
            }

            $result[$group] = $this->retrievePreviewData(Event::newsListById($ids, $order), $settings['visible']);
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
