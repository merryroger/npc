<?php
/**
 * ResourceLocator provider`s treat script
 * Created by: Merry Roger
 * Date: 06.10.2021
 */

if (!isset($extra_data['opcode'])) {
    $extra_data['opcode'] = '';
}

$erc = ['success' => 0, 'errorcode' => 0, 'section' => 'locations', 'options' => []];

switch (strtoupper($extra_data['opcode'])) {
    case 'REFM':
            $itemId = intval($extra_data['itemId']);
            $dataset = $provider->getItem($itemId);
            $vocabulary = $provider->getVocabulary(['common', 'locations']);
            $contents = view($sets['template'], compact(['dataset', 'vocabulary']))->render();
            //$contents = json_encode(array_merge($extra_data, ['view' => $view, 'vocabulary' => $vocabulary]));
        break;
    case 'IFRM':
    case 'IRRM':
        if ($provider->deleteRecord($extra_data, $erc)) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
            $vocabulary = $provider->getVocabulary(['common', 'locations']);
            $contents = json_encode(array_merge($extra_data, ['dataset' => $dataset, 'vocabulary' => $vocabulary]));
        } else {
            $contents = json_encode(array_merge($erc, $extra_data));
        }
        break;
    case 'RLAD':
        if ($id = $provider->addRecord($extra_data, $erc)) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
            $vocabulary = $provider->getVocabulary(['common', 'locations']);
            $contents = json_encode(array_merge($extra_data, ['dataset' => $dataset, 'vocabulary' => $vocabulary]));
        } else {
            $contents = json_encode(array_merge($erc, $extra_data));
        }
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
