<?php
/**
 * Created by: Merry Roger
 * Date: 05.07.2021
 */

    $xslt = '';
    $message = trans('flasherrors.news.preview');
    $messages = [];

    $capacity = $provider->checkNews();

    if ($capacity > 0) {
        $list = $provider->pickPreviewList($sets);

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

        if ($messages) {
            session()->put('errors.previews', $messages);
        }
    }

    $contents = view($sets['template'], compact(['capacity']))->render();
