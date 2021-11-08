<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageLoaderController extends Controller
{
    use \ehwaz\traits\XMLParsers;

    public function loadIcon(Request $request)
    {
        if ($request->has('rq')) {
            $rq = $request->get('rq');
            $path = realpath(public_path() . '/' . base64_decode($rq));
            $rq_width = ($request->has('width')) ? intval($request->get('width')) : 0;
            $rq_height = ($request->has('height')) ? intval($request->get('height')) : 0;
        } else {
            return;
        }

        $stream = file_get_contents($path);
        $size = getimagesize($path);
        $mime = $size['mime'];

        header("Content-Type: {$mime}");
        if ($rq_width || $rq_height) {
            if ($newSizes = $this->recalcSizes($rq_width, $rq_height, $size)) {
                $im = imagecreatetruecolor($newSizes['width'], $newSizes['height']);
                $white = imagecolorallocate($im, 255, 255, 255);
                imagefill($im, 0, 0, $white);
                switch ($mime) {
                    case 'image/jpeg':
                        $src_im = @imagecreatefromjpeg($path);
                        imagecopyresampled($im ,$src_im,0,0,0,0, $newSizes['width'], $newSizes['height'], $size[0], $size[1]);
                        imagejpeg($im);
                        break;
                    case 'image/png':
                        $src_im = @imagecreatefrompng($path);
                        imagecopyresampled($im ,$src_im,0,0,0,0, $newSizes['width'], $newSizes['height'], $size[0], $size[1]);
                        imagepng($im);
                        break;
                    case 'image/gif':
                        $src_im = @imagecreatefromgif($path);
                        imagecopyresampled($im ,$src_im,0,0,0,0, $newSizes['width'], $newSizes['height'], $size[0], $size[1]);
                        imagegif($im);
                        break;
                    case 'image/webp':
                        $src_im = @imagecreatefromwebp($path);
                        imagecopyresampled($im ,$src_im,0,0,0,0, $newSizes['width'], $newSizes['height'], $size[0], $size[1]);
                        imagewebp($im);
                        break;
                }
                imagedestroy($im);
                return;
            }
        }

        print $stream;
    }

    protected function recalcSizes($rw, $rh, &$sizes)
    {
        $iw = $sizes[0];
        $ih = $sizes[1];

        if ($rw && $rh) {
            if ($iw <= $rw && $ih <= $rh) {
                return false;
            }

            $kw = $iw / $rw;
            $kh = $ih / $rh;

            $ratio = ($kh > $kw) ? $kh : $kw;
        } elseif ($rw && !$rh) {
            $ratio = $iw / $rw;
        } elseif (!$rw && $rh) {
            $ratio = $ih / $rh;
        }

        return ['width' => round($iw / $ratio), 'height' => round($ih / $ratio)];
    }

}
