<?php
/**
 * ImageCollector provider`s treat script
 * Created by: Merry Roger
 * Date: 23.07.2021
 */

if (!isset($extra_data['opcode'])) {
    $extra_data['opcode'] = '';
}

switch (strtoupper($extra_data['opcode'])) {
    case 'CFUP':
        $checkPath = $provider->getFileUploadDir() . "/{$extra_data['pack_id']}";
        $out = [];
        $file_names = collect(json_decode($extra_data['fnames']))->all();
        $file_sizes = collect(json_decode($extra_data['fsizes']))->all();
        $file_types = collect(json_decode($extra_data['ftypes']))->all();

        foreach ($file_names as $idx => $file_name) {
            $out[$file_name] = 0;
            if (is_dir($checkPath)) {
                $destFile = realpath($checkPath . "/{$file_name}." . $file_types[$idx]);
                if (file_exists($destFile)) {
                    $fsize = filesize($destFile);
                    if (isset($fsize) && $fsize == $file_sizes[$idx]) {
                        $provider->storeUploadedFile($destFile, $extra_data['pack_id']);
                        $out[$file_name] = 1;
                        continue;
                    }
                }
            }
        }

        $contents = json_encode($out);
        break;
    case 'RITM':
        $provider->deleteItem(intval($extra_data['recId']));
    case 'CRLD':
        $provider->load($extra_data);
        $dataset = $provider->getContents();
        $view = view($sets['template'], compact(['dataset']))->render();
        $contents = json_encode(array_merge($extra_data, ['view' => $view]));
        break;
    case 'TITM':
        $provider->deleteItem(intval($extra_data['recId']));
    case 'CFLD':
    default:
        $total = \App\Models\Image::total();
        if ($total) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
        } else {
            $dataset = [];
        }

        if (!$extra_data['opcode']) {
            $contents = view($sets['template'], compact(['total', 'dataset']))->render();
        } else {
            $view = view($sets['template'], compact(['total', 'dataset']))->render();
            $contents = json_encode(array_merge($extra_data, ['view' => $view]));
        }
}
