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

    public function storeUploadedFile($destFile, $pack_id = null)
    {
        $storage_dir = addslashes(realpath(public_path() . $this::FILE_UPLOAD_BASE_DIR));
        $destination = preg_replace("%^({$storage_dir})%", '', $destFile);
        $id = DB::table('images')->max('id');
        $nextId = (isset($id)) ? intval($id) + 1 : 1;
        $sid = strval($nextId);
        while (strlen($sid) < 4) {
            $sid = '0' . $sid;
        }
        $sid = 'Image' . $sid;

        $image = new Image();
        $image->origin = $destination;
        if (isset($pack_id) && $pack_id) {
            $image->pack_id = $pack_id;
        }
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
    public function deleteItem($recId): bool
    {
        $storage_dir = realpath(public_path() . $this::FILE_UPLOAD_BASE_DIR);

        $rec = Image::find($recId);
        $rec->delete();

        $directory = pathinfo(realpath($storage_dir . $rec->origin));

        if (file_exists(realpath($storage_dir . $rec->origin))) {
            unlink(realpath($storage_dir . $rec->origin));
        }

        if (count(scandir($directory['dirname'])) == 2) {
            rmdir($directory['dirname']);
        }

        if (!Image::total()) {
            Image::truncate();
        }

        return true;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}
