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
    case 'RAFM':
        break;
    default:
        $total = \App\Models\Location::total();

        if ($total) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
            $vocabulary = $provider->getVocabulary(['common', 'locations']);
        } else {
            $dataset = $vocabulary = [];
        }

        if (!$extra_data['opcode']) {
            $vocabulary = json_encode($vocabulary);
            $contents = view($sets['template'], compact(['total', 'dataset', 'vocabulary']))->render();
        } else {
            $view = view($sets['template'], compact(['total', 'dataset']))->render();
            $contents = json_encode(array_merge($extra_data, ['view' => $view, 'vocabulary' => $vocabulary]));
        }
}
