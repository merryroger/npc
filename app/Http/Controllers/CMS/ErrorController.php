<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
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
        }

        return response()->json($this->response);
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
    }

    private function resetRequestData($erc, &$errdata)
    {
        $this->libPath = realpath($this::CMS_ERROR_SET_DIR . '/errors.xml');
        $this->errCode = erc;
        $this->options['section'] = $errdata['section'];
        $this->options['errorcode'] = $errdata['errorcode'];
    }

    private function pickErrorOptions($options = [])
    {
        $this->options = ($options) ? $options : [];
    }

    private function pickErrorSection($path)
    {
        $dir = pathinfo($path)['dirname'];
        $dsa = preg_split("%[\/\\\]%", $dir);
        $sect = ($dsa) ? array_pop($dsa) : 'default';
        unset($dsa, $dir);

        return ($sect == 'errors') ? 'default' : $sect;
    }

    private function getDefaultErrorResponse()
    {
        $type = trans('cms.errors.error');
        $description = trans('cms.errors.def_error');
        $this->response['view'] = view('cms.deferror', compact([
            'type', 'description'
        ]))->render();
    }

}
