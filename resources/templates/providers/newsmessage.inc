<?php
/**
 * Created by: Merry Roger
 * Date: 14.11.2021
 */

    $xslt = '';
    $message = '';
    $messages = [];

    $capacity = $provider->checkNews();

    if ($capacity > 0) {
        $newsId = $this->config['newsId'] = (isset($extra_data['nid']) && $extra_data['nid']) ?
            intval($extra_data['nid']) :
            $provider->getLastNewsId();
        $page = (isset($extra_data['page']) && $extra_data['page']) ? intval($extra_data['page']) : 1;

        do {
            if ($item = $provider->getItem($newsId)) {
                $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_news_date']);
                $this->config['collection_id'] = $item['collection_id'];
                if ($item['source']) {
                    $xslt = (isset($sets['xslt'])) ? $sets['xslt'] : [];
                    $bdr = addslashes($this->base_dir);
                    $doc_path = preg_replace("%^{$bdr}%sU", '', $item['source']);

                    $newsReader = app($sets['textprovider']);
                    $newsReader->load($doc_path, $this->base_dir, $page, $xslt);
                    $message = $newsReader->getContents();
                    $message .= "<h5>{$date}</h5>";
                } else {
                    $messages[] = preg_replace_callback(
                    "/<#=(\w+)\s+#>/U",
                        function ($val) use ($newsId, $date) {
                            return ${$val[1]};
                        },
                        trans('flasherrors.news.nosource')
                    );
                }

                break;
            } else {
                $this->config['collection_id'] = 0;
                $messages[] = preg_replace("/<#=newsId\s+#>/", $newsId, trans('flasherrors.news.nomessage'));
                if($newsId != $provider->getLastNewsId()) {
                    $newsId = $this->config['newsId'] = $provider->getLastNewsId();
                } else {
                    break;
                }
            }
        } while (true);

        if ($messages) {
            session()->put('errors.newsmessage', $messages);
        }
    }

    $contents = view($sets['template'], compact(['capacity', 'message']))->render();
