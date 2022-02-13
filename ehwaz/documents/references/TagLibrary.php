<?php
/**
 * Created by Ehwaz Raido.
 * Date: 25.01.2022
 */

namespace ehwas\documents\references;

use App\Models\Tag;

class TagLibrary extends References

{
    public function __construct()
    {
        parent::__construct();
    }

    public function getItem($recId): array
    {
        $location_item = Tag::find($recId);

        if ($location_item == null) {
            return [];
        } else {
            return Tag::where('id', $recId)->get()->map(function ($item, $key) {
                return collect($item)->except(['created_at', 'updated_at'])->all();
            })->first();
        }
    }

    public function addRecord($params, &$erc): int
    {
        $fields = collect($params)->only(['name'])->all();
        $matches = Tag::findMatches($fields)->get();

        if ($matches->count()) {
            $data = $this->retrieveMatches($matches, $params);
            $erc['options']['data'] = join(', ', $data);
            $erc['errorcode'] = (count($data) == 1) ? 0xda01 : 0xda02;

            return 0;
        } else {
            $tag = new Tag();

            $tag->name = $params['name'];

            $tag->save();
        }

        return $tag->id;
    }

    public function updateRecord($params, &$erc): bool
    {
        $recId = intval($params['itemId']);
        $fields = collect($params)->only(['name'])->all();
        $matches = Tag::findMatches($fields)->where('id', '!=', $recId)->get();

        if ($matches->count()) {
            $data = $this->retrieveMatches($matches, $params);
            $erc['options']['data'] = join(', ', $data);
            $erc['errorcode'] = 0xda01;

            return false;
        } else {
            $tag = Tag::find($recId);
            $tag->name = $params['name'];

            $tag->save();
        }

        return true;
    }

    public function deleteRecord($extra_data, &$erc): bool
    {
        $total = Tag::total();

        $recId = intval($extra_data['itemId']);
        $rec = Tag::find($recId);

        if ($total > 1) {
            $rec->delete();
        } else {
            $rec->truncate();
        }

        return true;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function loadTags($params, $extra): void
    {
        $this->contents = Tag::get()->map(function ($item, $key) {
            return collect($item)->except(['created_at', 'updated_at'])->all();
        })->all();
    }

    protected function retrieveMatches(&$matches, &$params): array
    {
        return $matches->map(function ($item, $key) use ($params) {
            $it = collect($item)->only(['name'])->filter(function ($item, $key) use ($params) {
                return $item == $params[$key];
            });

            return $it->keys()->map(function ($item, $key) {
                return trans("cms.references.locations.{$item}");
            })->all();

        })->first();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}
