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
        $storage_dir = addslashes(realpath(public_path() . $this::FILE_UPLOAD_RECEPTION_DIR));
        $destination = $this::FILE_UPLOAD_RECEPTION_DIR . preg_replace("%^({$storage_dir})%", '', $destFile);
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

    public function storePreview($destFile, $recId)
    {
        $image = Image::find($recId);
        $image->preview = $destFile;

        $image->save();
    }

    public function loadCollection($params, $extra): void
    {
        $this->contents = Image::dataSet()->get()->map(function ($item, $key) {
            return collect($item)->except(['created_at', 'updated_at'])->all();
        })->all();
    }

    public function getItem($recId): array
    {
        $item = Image::find($recId);

        if ($item == null) {
            return [];
        } else {
            $image = Image::where('id', $recId)->get()->map(function ($item, $key) {
                return collect($item)->except(['created_at', 'updated_at'])->all();
            })->first();

            if (file_exists(realpath(public_path() . $image['origin']))) {
                $directory = pathinfo(realpath(public_path() . $image['origin']));
                $image += getimagesize(realpath(public_path() . $image['origin']));
                $image += $directory;
            }

            if ($image['preview']) {
                $this->checkPreview($image);
            }

            return $image;
        }

    }

    protected function checkPreview(&$image): void
    {
        $previewPath = preg_replace("%[^\/\\\]+$%", '', $image['origin']) . $image['preview'];
        $preview = [
            'origin' => $previewPath
        ];

        if (file_exists(realpath(public_path() . $previewPath))) {
            $directory = pathinfo(realpath(public_path() . $previewPath));
            $preview += getimagesize(realpath(public_path() . $previewPath));
            $preview += $directory;

            $image['preview_info'] = $preview;
        }
    }

    public function deleteItem($recId): bool
    {
        $rec = Image::find($recId);
        $rec->delete();

        $directory = pathinfo(realpath(public_path() . $rec->origin));
        if ($rec->preview) {
            $this->previewFileRemove($rec);
        }

        if (file_exists(realpath(public_path() . $rec->origin))) {
            unlink(realpath(public_path() . $rec->origin));
        }

        if (count(scandir($directory['dirname'])) == 2) {
            rmdir($directory['dirname']);
        }

        if (!Image::total()) {
            Image::truncate();
        }

        return true;
    }

    public function deletePreview($recId): bool
    {
        $rec = Image::find($recId);

        $this->previewFileRemove($rec);

        $rec->preview = null;
        $rec->save();

        return true;
    }

    protected function previewFileRemove($rec): bool
    {
        $previewPath = preg_replace("%[^\/\\\]+$%", '', $rec->origin) . $rec->preview;
        $preview_dir = preg_replace("%[^\/\\\]+$%", '', $previewPath);

        if (file_exists(realpath(public_path() . $previewPath))) {
            unlink(realpath(public_path() . $previewPath));
        }

        if (count(scandir(realpath(public_path() . $preview_dir))) == 2) {
            rmdir(realpath(public_path() . $preview_dir));
        }

        return true;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}
