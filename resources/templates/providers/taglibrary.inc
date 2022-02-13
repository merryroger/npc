<?php
/**
 * TagLibrary provider`s treat script
 * Created by: Merry Roger
 * Date: 25.01.2022
 */

if (!isset($extra_data['opcode'])) {
    $extra_data['opcode'] = '';
}

$total = \App\Models\Tag::total();
$erc = ['success' => 0, 'errorcode' => 0, 'section' => 'locations', 'options' => []];

switch (strtoupper($extra_data['opcode'])) {
    case 'RTAD':
        if ($id = $provider->addRecord($extra_data, $erc)) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
            $vocabulary = $provider->getVocabulary(['common', 'tags']);
            if ($total) {
                $contents = json_encode(array_merge($extra_data, ['dataset' => $dataset, 'vocabulary' => $vocabulary]));
            } else {
                $total = 1;
                $vocabulary = json_encode($vocabulary);
                $view = view($sets['template'], compact(['total', 'dataset', 'vocabulary']))->render();
                $contents = json_encode(array_merge($extra_data, ['view' => $view,  'dataset' => $dataset, 'vocabulary' => $vocabulary]));
            }
        } else {
            $contents = json_encode(array_merge($erc, $extra_data));
        }
        break;
    case 'REFM':
        $itemId = intval($extra_data['itemId']);
        $dataset = $provider->getItem($itemId);
        $vocabulary = $provider->getVocabulary(['common', 'tags']);
        $contents = view($sets['template'], compact(['dataset', 'vocabulary']))->render();
        break;
    case 'RTUD':
        if ($provider->updateRecord($extra_data, $erc)) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
            $vocabulary = $provider->getVocabulary(['common', 'tags']);
            $contents = json_encode(array_merge($extra_data, ['dataset' => $dataset, 'vocabulary' => $vocabulary]));
        } else {
            $contents = json_encode(array_merge($erc, $extra_data));
        }
        break;
    case 'ITRM':
        if ($provider->deleteRecord($extra_data, $erc)) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
            $vocabulary = $provider->getVocabulary(['common', 'tags']);
            if ($total > 1) {
                $contents = json_encode(array_merge($extra_data, ['dataset' => $dataset, 'vocabulary' => $vocabulary]));
            } else {
                $total = 0;
                $view = view($sets['template'], compact(['total', 'dataset', 'vocabulary']))->render();
                $contents = json_encode(array_merge($extra_data, ['view' => $view]));
            }
        } else {
            $contents = json_encode(array_merge($erc, $extra_data));
        }
        break;
    default:
        if ($total) {
            $provider->load($extra_data);
            $dataset = $provider->getContents();
            $vocabulary = $provider->getVocabulary(['common', 'tags']);
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
