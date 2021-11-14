<?php
/**
 * Created by: Merry Roger
 * Date: 14.11.2021
 */

    $xslt = '';
    //$message = trans('flasherrors.news.message');
    $messages = [];

    $capacity = $provider->checkNews();

    if ($capacity > 0) {
        $newsId = $this->config['newsId'] = (isset($extra_data['nid']) && $extra_data['nid']) ?
            intval($extra_data['nid']) :
            $provider->getLastNewsId();

            if ($item = $provider->getItem($newsId)) {
                $this->config['collection_id'] = $item['collection_id'];
                if ($item['source']) {

                } else {
                    $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_news_date']);
                    $messages[] = preg_replace_callback(
                        "/<#=(\w+)\s+#>/U",
                        function($val) use($newsId, $date) { return ${$val[1]}; },
                        trans('flasherrors.news.nosource')
                    );
                }
            } else {
                $this->config['collection_id'] = 0;
                $messages[] = preg_replace("/<#=newsId\s+#>/", $newsId, trans('flasherrors.news.nomessage'));
            }

/*        $list = $provider->pickPreviewList($sets);

        foreach ($list as $item) {
            if (isset($item['preview'])) {
                $source = $item['preview'];
            } else {
                $source = $item['source'];
            }

            if ($source) {

            } else {
                $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_news_date']);
                $messages[] = preg_replace("/<#=date\s+#>/", $date, $message);
            }
        }
*/
        if ($messages) {
            session()->put('errors.newsmessage', $messages);
        }
    }

    $contents = view($sets['template'], compact(['capacity']))->render();
