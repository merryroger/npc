<?php
/**
 * Created by Ehwaz Raido.
 * Date: 05.07.2021
 */

namespace ehwas\news;

use App\Models\Event;

class NewslineReader
{

    public function __construct()
    {
    }

    public function load($doc_path = '', $base_dir = __DIR__, $page = 1, $xslt = []): void
    {
    }

    public function getNewsCount() {
        return Event::newsCount();
    }

    public function getContents() {
        return '';
    }

    public function __destruct()
    {
    }

}
