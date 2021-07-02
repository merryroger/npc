<?php
/**
 * Uses Tyrion framework family by Ehwaz Raido ( http://www.ehwaz.ru )
 * Created by Ehwaz Raido.
 * Date: 02.07.2021
 */

namespace ehwaz\traits;

trait Evaluators
{

    public function arrayEval($source, &$variables, $pattern): string
    {
        if (preg_match_all("/{$pattern}/sU", $source, $matches)) {
            $_matches_ = array_combine($matches[0], $matches[1]);
            unset($matches);

            foreach ($_matches_ as $patt => $variable) {
                $source = preg_replace("%{$patt}%", $variables[$variable], $source);
            }
        }

        return $source;
    }

}
