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

    public function addRecord($params): int
    {
        $fields = collect($params)->only(['name', 'rel_path'])->all();
        $matches = Location::findMatches($fields)->get();

        if ($matches->count()) {
            dd($matches);
        } else {
            $location = new Location();

            $location->name = $params['name'];
            $location->rel_path = $params['rel_path'];
            $location->hidden = $params['hidden'];

            $location->save();
        }
        return $location->id;
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

    public function __destruct()
    {
        parent::__destruct();
    }

}
