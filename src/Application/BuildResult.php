<?php
declare(strict_types=1);

namespace App\Application;


use App\Application\DTO\MogelzettelResult;
use App\Domain\Mogelzettel\FreiesFeld;
use App\Domain\Mogelzettel\MinenFeld;
use App\Domain\Mogelzettel\Mogelzettel;
use ReflectionClass;

final class BuildResult
{
    public function __invoke(Mogelzettel $mogelzettel): MogelzettelResult
    {
        $ro = new ReflectionClass($mogelzettel);
        $prop = $ro->getProperty('grid');
        $prop->setAccessible(true);
        $grid = $prop->getValue($mogelzettel);

        $listOfPositionsWithMine = [];
        $listOfPositionsWithMineCount = [];

        for($c = 0; $c < count($grid); $c++) {
            for($r = 0; $r < count($grid); $r++) {
                $feldPos = $grid[$c][$r];
                if($feldPos->getFeld() instanceof MinenFeld) {
                    $listOfPositionsWithMine[] = [$c, $r];
                }
                if($feldPos->getFeld() instanceof FreiesFeld) {
                    $listOfPositionsWithMineCount[] = [[$c, $r], $feldPos->getFeld()->getCount()];
                }
            }
        }


        return new MogelzettelResult(count($grid), $listOfPositionsWithMine, $listOfPositionsWithMineCount);
    }
}