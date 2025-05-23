<?php
/**
 * ImageCollector provider`s treat script
 * Created by: Merry Roger
 * Date: 23.07.2021
 */

if (!isset($extra_data['opcode'])) {
    $extra_data['opcode'] = '';
}

$erc = ['success' => 0, 'errorcode' => 0, 'section' => 'images', 'options' => []];

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
                        $provider->storeUploadedFile("/{$file_name}." . $file_types[$idx], $extra_data['pack_id']);
                        $out[$file_name] = 1;
                        continue;
                    }
                }
            }
        }

        $contents = json_encode($out);
        break;
    case 'PWUP':
        $result = 0;
        $recId = intval($extra_data['recId']);
        $image = $provider->getItem($recId);
        $checkPath = $image['dirname'] . '/preview';
        $preview = $image['filename'] . '.' . $extra_data['ftype'];

        if (is_dir($checkPath)) {
            $destFile = realpath($checkPath . "/{$preview}");
            if (file_exists($destFile)) {
                $fsize = filesize($destFile);
                if (isset($fsize) && $fsize == intval($extra_data['fsize'])) {
                    $provider->storePreview('preview/' . $preview, $recId);
                    $result = 1;
                }
            }
        }

        $contents = json_encode($result);
        break;
    case 'PWAF':
        $image = collect($extra_data)->only(['recId'])->all();
        $view = view($sets['template'], compact(['image']))->render();
        $contents = json_encode(array_merge($extra_data, ['view' => $view]));
        break;
    case 'PWRM':
        $provider->deletePreview(intval($extra_data['recId']));
    case 'PRLD':
    case 'EDIM':
        $image = $provider->getItem($extra_data['recId']);// dd($image);
        $locations = $provider->getLocations(false);// dd($locations);
        $view = view($sets['template'], compact(['image', 'locations']))->render();
        $contents = json_encode(array_merge($extra_data, ['view' => $view]));
        break;
    case 'ETAG':
        $image = $provider->getItem($extra_data['recId']);// dd($image);
        $view = view($sets['template'], compact(['image']))->render();
        $contents = json_encode(array_merge($extra_data, ['view' => $view]));
        break;
    case 'RIRL':
        $image = $provider->getItem($extra_data['recId']);
        $locateTo = collect($extra_data)->except(['recId', 'opcode'])->merge(['pack_id' => $image['pack_id']])->all();
        if ($provider->imageRelocate($image, $locateTo, $erc)) {
            $image = $provider->getItem($extra_data['recId']);
            $result = ['def_location' => $image['location'], 'fn_hash' => md5($locateTo['file_name'])];
            $contents = json_encode(array_merge($extra_data, $result));
        } else {
            $contents = json_encode(array_merge($erc, $extra_data));
        }
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
