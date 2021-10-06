<?php
/**
 * Created by Ehwaz Raido.
 * Date: 06.10.2021
 */

namespace ehwas\documents\references;

class ResourceLocatior
{

    protected $contents;

    public function __construct()
    {
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function loadLocations($params, $extra): void
    {
//        $this->contents = Image::dataSet()->get()->map(function ($item, $key) {
//            return collect($item)->except(['created_at', 'updated_at'])->all();
//        })->all();
        $this->contents = []; //!!!!!!!!!!!!!!!!! Temporary line !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    }
/*
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

*/
    public function __destruct()
    {
    }

}
