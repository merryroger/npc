<?php
/**
 * Created by Ehwaz Raido.
 * Date: 06.10.2021
 */

namespace ehwas\documents\references;

use App\Models\Location;

class ResourceLocatior extends References

{
    public function __construct()
    {
        parent::__construct();
    }

    public function getItem($recId): array
    {
        $location_item = Location::find($recId);

        if ($location_item == null) {
            return [];
        } else {
            return Location::where('id', $recId)->get()->map(function ($item, $key) {
                return collect($item)->except(['created_at', 'updated_at'])->all();
            })->first();
        }
    }

    public function addRecord($params, &$erc): int
    {
        $fields = collect($params)->only(['name', 'rel_path'])->all();
        $matches = Location::findMatches($fields)->get();

        if ($matches->count()) {
            $data = $this->retrieveMatches($matches, $params);
            $erc['options']['data'] = join(', ', $data);
            $erc['errorcode'] = (count($data) == 1) ? 0xda01 : 0xda02;

            return 0;
        } else {
            $location = new Location();

            $location->name = $params['name'];
            $location->rel_path = $params['rel_path'];
            $location->hidden = $params['hidden'];

            $location->save();

            $this->checkRelPath($params['rel_path'], ['preview']);
        }

        return $location->id;
    }

    public function deleteRecord($extra_data, &$erc): bool
    {
        $opcode = strtoupper($extra_data['opcode']);
        $recId = intval($extra_data['itemId']);

        $location = Location::locationDirById($recId);
        $rec = Location::find($recId);
        $rec->delete();

        if ($opcode == 'IFRM') {
            $this->removeDirectories($location, ['preview']);
        }

        return true;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function loadLocations($params, $extra): void
    {
        $showHidden = !(isset($params['nohidden']) && $params['nohidden']);

        $this->contents = Location::dataSet($showHidden)->get()->map(function ($item, $key) {
            return collect($item)->except(['created_at', 'updated_at'])->all();
        })->all();
    }

    protected function retrieveMatches(&$matches, &$params): array
    {
        return $matches->map(function ($item, $key) use ($params) {
            $it = collect($item)->only(['name', 'rel_path'])->filter(function ($item, $key) use ($params) {
                return $item == $params[$key];
            });

            return $it->keys()->map(function ($item, $key) {
                return trans("cms.references.locations.{$item}");
            })->all();

        })->first();
    }

    protected function checkRelPath($rel_path, $extra_subdirs = []): void
    {
        $path = '';

        if (!is_dir(public_path() . $rel_path)) {
            $parts = preg_split("/[\/\\\]+/sU", $rel_path);
            if ($extra_subdirs) {
                $parts = array_merge($parts, $extra_subdirs);
            }

            $path .= join('/', array_splice($parts, 0, 2));
            $this->checkSubDir($path, $parts);
        }
    }

    protected function checkSubDir($path, &$parts): void
    {
        if (!is_dir(public_path() . $path)) {
            mkdir(public_path() . $path);
        }

        if ($parts) {
            $path .= '/' . array_splice($parts, 0, 1)[0];
            $this->checkSubDir($path, $parts);
        }
    }

    protected function removeDirectories($location, $extra_subdirs = []): void
    {
        do {
            $extra_path = ($extra_subdirs) ? '/' . join('/', $extra_subdirs) : '';
            if ($extra_path && is_dir(public_path() . $location . $extra_path)) {
                $this->cleanDir(public_path() . $location . $extra_path);
                rmdir(public_path() . $location . $extra_path);
            }

            array_pop($extra_subdirs);
        } while ($extra_subdirs);

        if (is_dir(public_path() . $location)) {
            $this->cleanDir(public_path() . $location);
            rmdir(public_path() . $location);
        }
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}
