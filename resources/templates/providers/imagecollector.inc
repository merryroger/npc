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

        foreach($file_names as $idx => $file_name) {
            $out[$file_name] = 0;
            if (is_dir($checkPath)) {
                $destFile = realpath($checkPath . "/{$file_name}." . $file_types[$idx]);
                if (file_exists($destFile)) {
                    $fsize = filesize($destFile);
                    if (isset($fsize) && $fsize == $file_sizes[$idx]) {
                        $out[$file_name] = 1;
                        continue;
                    }
                }
            }
        }

        $contents = json_encode($out);
        break;
    default:
        $total = \App\Models\Image::total();
        $contents = view($sets['template'], compact(['total']))->render();
}
