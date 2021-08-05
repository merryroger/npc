<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents\collections;


use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageCollector extends Collections
{

    public function __construct()
    {
        parent::__construct();
    }

    public function storeUploadedFile($destFile)
    {
        $id = DB::table('images')->max('id');
        $nextId = (isset($id)) ? intval($id) + 1 : 1;
        $sid = strval($nextId);
        while (strlen($sid) < 4) {
            $sid = '0' . $sid;
        }
        $sid = 'Image' . $sid;

        $image = new Image();
        $image->origin = $destFile;
        $image->info = $sid;
        $image->save();
    }

    public function loadCollection($params, $extra): void
    {
        $this->contents = Image::dataSet()->get()->map(function($item, $key) {
            return collect($item)->except(['created_at', 'updated_at'])->all();
        })->all();
    }
/*
    public function getParameter($param): string
    {
        switch (strtolower($param)) {
            case 'contents':
            case 'docheader':
            case 'colontitule':
            case 'stamps': return $this->$param;
            default: return '';
        }

    }
*/
    public function __destruct()
    {
        parent::__destruct();
    }

}
