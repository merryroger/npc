<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwaz\interfaces;

interface ExtendedDocumentProvider
{

    public function load($src, ...$params);

    public function getContents();

}
