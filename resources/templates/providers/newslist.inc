<?php
/**
 * Created by: Merry Roger
 * Date: 14.11.2021
 */

    $xslt = '';
    $previewOrig = true;
    $bdr = addslashes($this->base_dir);
    $message = trans('flasherrors.news.preview');
    $messages = [];
    $previews = [];

    $capacity = $provider->checkNews();

    if ($capacity > 0) {
        $info = ['capacity' => $capacity];
        $newsId = $this->config['newsId'];
        $newsReader = app($sets['textprovider']);
        $list = $provider->pickPreviewSurroundList($newsId, $sets, $info);

        foreach ($list as $group => $groupSet) {
            foreach ($groupSet as $item) {
                $nid = $item['id'];
                $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_news_date']);
                $stamp = preg_replace("/([\s\-\:])+/", "", $item['official_news_date']);

                if (isset($item['preview'])) {
                    $source = $item['preview'];
                    $previewOrig = true;
                } else {
                    $source = $item['source'];
                    $previewOrig = false;
                }

                if ($source) {
                    $doc_path = preg_replace("%^{$bdr}%sU", '', $source);
                    $newsReader->load($doc_path, $this->base_dir, 1, $xslt);

                    if ($previewOrig) {
                        $contents = $newsReader->getContents();
                        $previews[] = view($sets['haspreview'], compact(['nid', 'group', 'stamp', 'contents']))->render();
                    } else {
                        $docname = $newsReader->getParameter('docname');
                        $previews[] = view($sets['nopreview'], compact(['nid', 'group', 'date', 'stamp', 'docname']))->render();
                    }
                } else {
                    $messages[] = preg_replace("/<#=date\s+#>/", $date, $message);
                }
            }
        }

        if ($messages) {
            session()->put('errors.previews', $messages);
        }
    }

    $contents = view($sets['template'], compact(['capacity', 'previews', 'info']))->render();
