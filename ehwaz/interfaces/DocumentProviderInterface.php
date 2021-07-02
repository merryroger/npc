<?php
/**
 * Created by Ehwaz Raido.
 * Date: 02.07.2021
 */

namespace ehwaz\interfaces;

interface DocumentProvider
{

    public function load($src, ...$params);

    public function getContents();

}
