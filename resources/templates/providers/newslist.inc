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

if (!isset($extra_data['opcode'])) {
    $extra_data['opcode'] = '';
}

$capacity = $provider->checkNews();

switch (strtoupper($extra_data['opcode'])) {
    case 'RQPW':
        $out = [];
        $nid = intval($extra_data['nid']);
        $info = ['capacity' => $capacity, 'visible' => $sets['visible'], 'current' => $nid];
        $list = $provider->pickPreviewSurroundList($nid, $sets, $info);
        $group = '';
        $item = $list['selected'][0];

        $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_news_date']);
        $stamp = preg_replace("/([\s\-\:])+/", "", $item['official_news_date']);
        $out['neighbours'] = base64_encode(json_encode($item['neighbours']));

        if (isset($item['preview'])) {
            $source = $item['preview'];
            $previewOrig = true;
        } else {
            $source = $item['source'];
            $previewOrig = false;
        }

        if ($source) {
            $doc_path = preg_replace("%^{$bdr}%sU", '', $source);

            $newsReader = app($sets['textprovider']);
            $newsReader->load($doc_path, $this->base_dir, 1, $xslt);

            if ($previewOrig) {
                $out['text'] = $newsReader->getContents();
            } else {
                $docname = $newsReader->getParameter('docname');
                $out[] = view($sets['nopreview'], compact(['nid', 'group', 'date', 'stamp', 'neighbours', 'docname']))->render();
            }
        } else {
            $out['errors'] = preg_replace("/<#=date\s+#>/", $date, $message);
        }

        $contents = json_encode($out);
        break;
    default:
        if ($capacity > 0) {
            $newsId = $this->config['newsId'];
            $info = ['capacity' => $capacity, 'visible' => $sets['visible'], 'current' => $newsId];
            $newsReader = app($sets['textprovider']);
            $list = $provider->pickPreviewSurroundList($newsId, $sets, $info);

            foreach ($list as $group => $groupSet) {
                foreach ($groupSet as $item) {
                    $nid = $item['id'];
                    $date = preg_replace("/^(\d{4})-(\d{2})-(\d{2}).+$/", "\\3.\\2.\\1", $item['official_news_date']);
                    $stamp = preg_replace("/([\s\-\:])+/", "", $item['official_news_date']);
                    $neighbours = base64_encode(json_encode($item['neighbours']));

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
                            $previews[] = view($sets['haspreview'], compact(['nid', 'group', 'stamp', 'neighbours', 'contents']))->render();
                        } else {
                            $docname = $newsReader->getParameter('docname');
                            $previews[] = view($sets['nopreview'], compact(['nid', 'group', 'date', 'stamp', 'neighbours', 'docname']))->render();
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

}