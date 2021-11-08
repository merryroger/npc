<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents\collections;


use App\Models\Image;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class ImageCollector extends Collections
{

    public function __construct()
    {
        parent::__construct();
    }

    public function storeUploadedFile($destFile, $pack_id = null)
    {
        $id = DB::table('images')->max('id');
        $nextId = (isset($id)) ? intval($id) + 1 : 1;
        $sid = strval($nextId);
        while (strlen($sid) < 4) {
            $sid = '0' . $sid;
        }
        $sid = 'Image' . $sid;

        $image = new Image();
        $image->location = 1;
        $image->origin = $destFile;
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
            $this->getLocationDir($item);

            return collect($item)->except(['created_at', 'updated_at'])->all();
        })->all();
    }

    protected function getLocationDir(&$item): void
    {
        $relPath = Location::locationDirById($item['location']);
        $item['rel_path'] = (intval($item['location']) > 1) ? $relPath : $relPath . "/{$item['pack_id']}";
    }

    public function getLocations($show_hidden = true): array
    {
        $locations = Location::dataSet($show_hidden)->get();
        if ($locations->count()) {
            return $locations->map(function ($item, $key) {
                return collect($item)->only(['id', 'name'])->all();
            })->all();
        } else {
            return [];
        }
    }

    public function getItem($recId): array
    {
        $image_item = Image::find($recId);

        if ($image_item == null) {
            return [];
        } else {
            $image = $this->pickImageData($recId);

            if ($image['preview']) {
                $this->checkPreview($image);
            }

            return $image;
        }

    }

    protected function pickImageData($recId): array
    {
        $image = Image::where('id', $recId)->get()->map(function ($item, $key) {
            $this->getLocationDir($item);

            return collect($item)->except(['created_at', 'updated_at'])->all();
        })->first();

        if (file_exists(realpath(public_path() . $image['rel_path'] . $image['origin']))) {
            $directory = pathinfo(realpath(public_path() . $image['rel_path'] . $image['origin']));
            $image += getimagesize(realpath(public_path() . $image['rel_path'] . $image['origin']));
            $image += $directory;
        }

        return $image;
    }

    protected function checkPreview(&$image): void
    {
        $previewPath = $image['rel_path'] . '/' . $image['preview'];

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
        $image = $this->pickImageData($recId);
        if ($image['preview']) {
            $this->checkPreview($image);
        }

        $rec = Image::find($recId);
        $rec->delete();

        if ($rec->preview) {
            $this->previewFileRemove($image);
        }

        if (file_exists(realpath($image['dirname'] . $rec->origin))) {
            unlink($image['dirname'] . $rec->origin);
        }

        if (count(scandir($image['dirname'])) == 2) {
            rmdir($image['dirname']);
        }

        if (!Image::total()) {
            Image::truncate();
        }

        return true;
    }

    public function deletePreview($recId): bool
    {
        $image = $this->pickImageData($recId);
        $this->checkPreview($image);

        $rec = Image::find($recId);
        $rec->preview = null;
        $rec->save();

        $this->previewFileRemove($image);

        return true;
    }

    protected function previewFileRemove($image): bool
    {
        if (file_exists(realpath(public_path() . $image['preview_info']['origin']))) {
            unlink(realpath(public_path() . $image['preview_info']['origin']));
        }

        if (count(scandir(realpath($image['preview_info']['dirname']))) == 2) {
            rmdir(realpath($image['preview_info']['dirname']));
        }

        return true;
    }

    public function imageRelocate($currentImageData, $requestedData, &$erc): bool
    {
        $this->getLocationDir($requestedData);
        $forceOverwrite = intval($requestedData['force_overwrite']);
        $newLocation = public_path() . $requestedData['rel_path'];
        $newFileName = $requestedData['file_name'] . ".{$currentImageData['extension']}";

        if ($currentImageData['location'] == intval($requestedData['location']) && !strcasecmp($currentImageData['filename'], $requestedData['file_name'])) {
            $erc['errorcode'] = 0xe3;
            return false;
        }

        if (!$this->checkLocation($newLocation, $newFileName, $forceOverwrite, $erc)) {
            return false;
        }

        if ($currentImageData['preview'] != null) {
            $newPreviewFile = $requestedData['file_name'] . ".{$currentImageData['preview_info']['extension']}";
            if (!$this->checkLocation($newLocation . '/preview', $newPreviewFile, $forceOverwrite, $erc)) {
                return false;
            }
        }

        $image = Image::find($currentImageData['id']);
        $image->location = intval($requestedData['location']);
        $image->origin = '/' . $newFileName;
        if ($currentImageData['preview'] != null) {
            $image['preview'] = 'preview/' . $newPreviewFile;
        }
        $image->save();

        @rename($currentImageData['dirname'] . $currentImageData['origin'], realpath($newLocation) . '/' . $newFileName);
        if ($currentImageData['preview'] != null) {
            $pw = $currentImageData['preview_info'];
            @rename($pw['dirname'] . "/{$pw['basename']}", realpath($newLocation . '/preview') . '/' . $newPreviewFile);
        }

        return true;
    }

    protected function checkLocation($path, $fileName, $fOW, &$erc): bool
    {
        $realpath = realpath($path);
        if (!$realpath) {
            if (!mkdir($path)) {
                $erc['errorcode'] = 0xe4;
                return false;
            }

            if (!$realpath = realpath($path)) {
                $erc['errorcode'] = 0xe5;
                return false;
            }
        }

        if (!$fOW && is_file($realpath . "/{$fileName}")) {
            $erc['errorcode'] = 0xe6;
            return false;
        }

        return true;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}
