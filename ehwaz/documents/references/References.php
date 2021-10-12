<?php
/**
 * Created by Ehwaz Raido.
 * Date: 12.10.2021
 */

namespace ehwas\documents\references;


class References
{
    protected const DEFAULT_REFERENCE_SECTION = 'cms.references.';

    protected $contents;

    public function __construct()
    {
    }

    public function loadLocations($params, $extra): void
    {
    }

    public function getVocabulary($topics): array
    {
        $voc = [];

        foreach ($topics as $topic) {
            $voc += trans($this::DEFAULT_REFERENCE_SECTION . $topic);
        }

        return $voc;
    }

    public function __destruct()
    {
    }

}
