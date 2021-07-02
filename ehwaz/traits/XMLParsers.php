<?php
/**
 * Uses Tyrion framework family by Ehwaz Raido ( http://www.ehwaz.ru )
 * Created by Ehwaz Raido.
 * Date: 02.07.2021
 */

namespace ehwaz\traits;

trait XMLParsers
{

    public function tagParser($tag, $search_params, &$contents, $single_mode = false): array
    {
        $search = $this->parseSearchParameters($search_params);
        $expr = '<' . $tag . '\s+' . $search . '[^>]*>(.+)<\/' . $tag . '>';

        $out = ($single_mode) ? $this->plainDataParser($expr, $contents) : $this->multDataParser($expr, $contents);

        return $out;
    }

    public function plainDataParser($expr, &$contents): array
    {
        if (preg_match("%{$expr}%sU", $contents, $matches)) {
            return $matches;
        } else {
            return [];
        }
    }

    public function multDataParser($expr, &$contents): array
    {
        if (preg_match_all("%{$expr}%sU", $contents, $matches)) {
            return $matches;
        } else {
            return [];
        }
    }

    public function pickTagSubdata($tag, &$contents): string
    {
        if (preg_match("%<{$tag}>(.+)<\/{$tag}>%sU", $contents, $matches)) {
            return $matches[1];
        } else {
            return '';
        }
    }

    public function easeParser(&$contents): array
    {
        $expr = '<(\w+)>(.+)<\/\\1>';
        if(preg_match_all("/{$expr}/sU", $contents, $matches)) {
            return array_combine($matches[1], $matches[2]);
        } else {
            return [];
        }
    }

    private function parseSearchParameters(&$spm): string
    {
        if ($spm) {
            $search = [];
            foreach ($spm as $pmName => $pmValue) {
                $search[] = "{$pmName}=\"{$pmValue}\"";
            }

            return join('\s+', $search);
        }

        return '';
    }

}
