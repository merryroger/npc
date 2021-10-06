<?php
/**
 * ResourceLocator provider`s treat script
 * Created by: Merry Roger
 * Date: 06.10.2021
 */

if (!isset($extra_data['opcode'])) {
    $extra_data['opcode'] = '';
}

switch (strtoupper($extra_data['opcode'])) {
    default:
        $total = 0; //\App\Models\Image::total();
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
