<?php
/**
 * TagLibrary provider`s treat script
 * Created by: Merry Roger
 * Date: 25.01.2022
 */

if (!isset($extra_data['opcode'])) {
    $extra_data['opcode'] = '';
}

$erc = ['success' => 0, 'errorcode' => 0, 'section' => 'locations', 'options' => []];

switch (strtoupper($extra_data['opcode'])) {
    default:
        $total = \App\Models\Tag::total();

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
