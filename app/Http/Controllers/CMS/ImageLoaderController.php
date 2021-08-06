<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageLoaderController extends Controller
{
    use \ehwaz\traits\XMLParsers;

    private const USER_STORAGE_DIR = __DIR__ . '/../../../../storage';

    public function loadIcon(Request $request)
    {
        $rq = $request->get('rq');
        $path = realpath($this::USER_STORAGE_DIR . '/' . base64_decode($rq));
        /*        if (!isset($rq['id']) || !$rq['id']) {
                    return;
                }

                $path_parts = preg_split("/\//", $rq['id']);

                $icon_index = array_pop($path_parts);
                array_push($path_parts, 'index.xml');

                $image_data = file_get_contents($this::USER_STORAGE_DIR . '/' . join('/', $path_parts));
                $search = [ 'index' => $icon_index ];
                if(!$ims = $this->tagParser('image', $search, $image_data, true)) {
                    return;
                } else {
                    $image_path = $this::USER_STORAGE_DIR . '/' . $ims[1];
                    unset($ims);
                }

                $size = getimagesize($image_path);
                $mime = $size['mime'];

                header("Content-Type: {$mime}");

                $im=imagecreatetruecolor(36, 36);
                $white = imagecolorallocate($im, 255, 255, 255);
                imagefill($im, 0, 0, $white);
                $src_im = @imagecreatefrompng($image_path);
                imagecopyresampled($im ,$src_im,0,0,0,0, 36, 36, 36,36);

                imagepng($im);
                imagedestroy($im);*/
        //return $stream;
    }
}
