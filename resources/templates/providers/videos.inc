<?php
/**
 * Created by: Merry Roger
 * Date: 06.12.2021
 */

    $xslt = '';
    $videos = [];
    $bdr = addslashes($this->base_dir);
    $message = trans('flasherrors.video.nocomment');

    $capacity = $provider->checkVideos();

    if ($capacity > 0) {
        $textReader = app($sets['textprovider']);
        $page = (isset($extra_data['page']) && $extra_data['page']) ? intval($extra_data['page']) : 1;
        $list = $provider->loadPageList($page, $sets);

        foreach($list as $item) {
            $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_video_date']);
            if (isset($item['comment']) && $item['comment']) {
                $doc_path = preg_replace("%^{$bdr}%sU", '', $item['comment']);
                $textReader->load($doc_path, $this->base_dir, 1, $xslt);
                $item['comment'] = $textReader->getContents();
            } elseif (isset($item['comment']) && $item['comment'] === false) {
                session()->put('errors.previews', [preg_replace("/<#=date\s+#>/", $date, $message)]);
                $item['comment'] = '';
            } else {
                $item['comment'] = '';
            }

            $videos[] = view($sets['preview_template'], compact(['item', 'date']))->render();
        }

        while (count($videos) % 3) {
            $videos[] = view($sets['preview_empty'])->render();
        }
    }

    $contents = view($sets['template'], compact(['capacity', 'videos']))->render();
