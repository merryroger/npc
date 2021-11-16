<?php
/**
 * Created by: Merry Roger
 * Date: 05.07.2021
 */

    $xslt = (isset($sets['xslt'])) ? $sets['xslt'] : [];
    $bdr = addslashes($this->base_dir);
    $message = trans('flasherrors.news.preview');
    $previewOrig = true;
    $messages = [];
    $previews = [];

    $capacity = $provider->checkNews();

    if ($capacity > 0) {
        $list = $provider->pickPreviewList($sets);
        $newsReader = app($sets['textprovider']);

        foreach ($list as $item) {
            $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_news_date']);

            if (isset($item['preview'])) {
                $source = $item['preview'];
                $previewOrig = true;
            } else {
                $source = $item['source'];
                $previewOrig = false;
            }

            if ($source) {
                $newsId = $item['id'];
                $doc_path = preg_replace("%^{$bdr}%sU", '', $source);
                $newsReader->load($doc_path, $this->base_dir, 1, $xslt);

                if ($previewOrig) {
                    $contents = $newsReader->getContents();
                    $previews[] = view($sets['haspreview'], compact(['newsId', 'contents']))->render();
                } else {
                    $docname = $newsReader->getParameter('docname');
                    $previews[] = view($sets['nopreview'], compact(['newsId', 'date', 'docname']))->render();
                }

            } else {
                $messages[] = preg_replace("/<#=date\s+#>/", $date, $message);
            }
        }

        if ($messages) {
            session()->put('errors.previews', $messages);
        }
    }

    $contents = view($sets['template'], compact(['capacity', 'previews']))->render();
