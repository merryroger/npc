<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function MongoDB\BSON\fromJSON;

class ErrorController extends Controller
{

    use \ehwaz\traits\XMLParsers;
    use \ehwaz\traits\Transcoders;

    const CMS_ERROR_SET_DIR = __DIR__ . '/../../../../resources/errors';
    const TRIES_TO_GET_ERROR = 5;

    const ERR_UNKNOWN_ERROR = 0x00;
    const ERR_INVALID_SECTION_REQUESTED = 0x01;
    const ERR_NONEXISTENT_ERROR_DATA_SOURCE = 0x02;
    const ERR_CORRUPTED_ERROR_DATA_SOURCE = 0x03;
    const ERR_INVALID_ERROR_DATA_SOURCE = 0x04;

    private $errCode;
    private $libPath;
    private $options;
    private $response;

    public function handleRequest(Request $request)
    {
        $this->pickErrorOptions($request->request->get('options'));
        $this->exploreLibPath($request->only(['errorcode', 'section']));
        $retries = $this::TRIES_TO_GET_ERROR;
        while (!$this->pickErrorSet() && $retries >= 0) {
            $retries--;
        }

        if ($retries < 0) {
            $this->getDefaultErrorResponse();
        } else {
            $this->response['options'] = $this->options;
        }

        $this->applyOptions();

        return $this->render();
    }

    private function exploreLibPath($errdata)
    {
        $this->libPath = ($errdata['section'] == 'default') ? $this::CMS_ERROR_SET_DIR : $this::CMS_ERROR_SET_DIR . "/{$errdata['section']}";
        if (!realpath($this->libPath . '/errors.xml')) {
            $this->resetRequestData($this::ERR_NONEXISTENT_ERROR_DATA_SOURCE, $errdata);
        } else {
            $this->libPath = realpath($this->libPath . '/errors.xml');
            $this->errCode = $errdata['errorcode'];
        }
    }

    private function pickErrorSet()
    {
        $options = [
            'section' => $this->pickErrorSection($this->libPath),
            'errorcode' => $this->errCode
        ];

        if (!$contents = file_get_contents($this->libPath)) {
            $this->resetRequestData($this::ERR_CORRUPTED_ERROR_DATA_SOURCE, $options);
            return false;
        }

        if (!$dataset = $this->splitAndRecode($contents)) {
            $this->resetRequestData($this::ERR_INVALID_ERROR_DATA_SOURCE, $options);
            return false;
        }

        unset($contents);

        if (!$this->pickDescription($dataset)) {
            $this->resetRequestData($this::ERR_UNKNOWN_ERROR, $options);

            return false;
        }

        $this->pickControls($dataset);

        //$dataset['options'] = $this->options;
        $this->response = $dataset;

        return true;
    }

    private function resetRequestData($erc, &$errdata)
    {
        $this->libPath = realpath($this::CMS_ERROR_SET_DIR . '/errors.xml');
        $this->errCode = $erc;
        $this->options['section'] = $errdata['section'];
        $this->options['errorcode'] = $errdata['errorcode'];
    }

    private function pickErrorOptions($options = [])
    {
        $this->options = ($options) ? json_decode($options, true) : [];
    }

    private function pickErrorSection($path)
    {
        $dir = pathinfo($path)['dirname'];
        $dsa = preg_split("%[\/\\\]%", $dir);
        $sect = ($dsa) ? array_pop($dsa) : 'default';
        unset($dsa, $dir);

        return ($sect == 'errors') ? 'default' : $sect;
    }

    private function splitAndRecode(&$contents)
    {
        $search = [
            'language' => app()->getLocale(),
            'encoding' => '([\w\d_-]+)'
        ];

        if (!$errDataSet = $this->tagParser('errorset', $search, $contents, true)) {
            return false;
        }

        if (!$errDataSet[] = $this->pickTagSubdata('controls', $contents)) {
            return false;
        }

        $search['encoding'] = $errDataSet[1];
        unset($errDataSet[0]);
        $this->recode($errDataSet);
        $search['dataset'] = array_shift($errDataSet);
        $search['controls'] = array_shift($errDataSet);
        unset($errDataSet);

        return $search;
    }

    private function pickDescription(&$dataset)
    {
        $mnemo = $this->buldErrorMnemoCode();
        $search = ['type' => '(error|warning)'];
        if (!$descr = $this->tagParser($mnemo, $search, $dataset['dataset'], true)) {
            return false;
        }

        $dataset['type'] = $descr[1];
        $dataset['description'] = $descr[2];
        unset($descr, $dataset['dataset']);

        return true;
    }

    private function applyOptions()
    {
        $opt = '';
        $pattern = '#=@([\w_]+)\s#';
        if ($inserts = $this->multDataParser($pattern, $this->response['description'])) {
            foreach ($inserts[0] as $idx => $insert) {
                $ins = "@{$inserts[1][$idx]}";
                switch (strtolower($ins)) {
                    case '@data_nosp':
                    case '@data':
                        if (isset($this->options['data'])) {
                            $opt = strcasecmp($ins, '@data') ? $this->options['data'] : ' ' . $this->options['data'];
                        }
                        break;
                    case '@erc':
                        if (isset($this->response['options']['errorcode'])) {
                            $opt = intval($this->response['options']['errorcode']);
                        }
                        break;
                    case '@herc':
                        if (isset($this->response['options']['errorcode'])) {
                            $erc = intval($this->response['options']['errorcode']);
                            $opt = '0' . $this->buldErrorMnemoCode($erc);
                        }
                        break;
                    case '@section':
                        if (isset($this->options['section']) && $this->options['section']) {
                            $opt = ' &#171;' . $this->options['section'] . '&#187;';
                        }
                        break;
                    default:
                        continue 2;
                        break;
                }

                $this->response['description'] = preg_replace("%{$insert}%", $opt, $this->response['description']);
            }
        }
    }

    private function pickControls(&$dataset)
    {
        $ctrls = [];
        $options = $this->options;
        $mnemo = $this->buldErrorMnemoCode();
        $search = ['label' => '([0-9A-Za-z_\.]+)'];
        if ($ctset = $this->tagParser($mnemo, $search, $dataset['controls'])) {
            foreach ($ctset[1] as $idx => $label) {
                $ctrl['label'] = trans($label);
                $ctrl['handler'] = view($ctset[2][$idx], compact(['options']))->render();
                $ctrls[] = view('cms.errors.components.button', compact(['ctrl']))->render();
            }
        } else {
            $ctrl['label'] = trans('cms.errors.ok');
            $ctrl['handler'] = view('cms.errors.nop')->render();
            $ctrls[] = view('cms.errors.components.button', compact(['ctrl']))->render();
        }

        $dataset['controls'] = view('cms.errors.components.controls', compact(['ctrls']))->render();
        unset($ctrls);
    }

    private function buldErrorMnemoCode($erc = null)
    {
        $mnemo = ($erc == null) ? dechex($this->errCode) : dechex($erc);
        return (strlen($mnemo) % 2) ? "x0{$mnemo}" : "x{$mnemo}";
    }

    private function getDefaultErrorResponse()
    {
        $type = trans('cms.errors.error');
        $description = trans('cms.errors.def_error');
        $this->response['view'] = view('cms.errors.deferror', compact([
            'type', 'description'
        ]))->render();
    }

    private function render()
    {
        $this->response['errorcode'] = '0' . $this->buldErrorMnemoCode($this->errCode);
        $errorSet = $this->response;
        $response['view'] = view('cms.errors.components.panel', compact(['errorSet']))->render();

        return response()->json($response);
    }

}
