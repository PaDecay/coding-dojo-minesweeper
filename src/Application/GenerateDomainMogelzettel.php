<?php


namespace App\Application;

use App\Domain\Mogelzettel\Mogelzettel;
use App\Domain\Operation\MogelzettelGenerator;
use App\Domain\Spielfeld\FreiesFeld;
use App\Domain\Spielfeld\MinenFeld;
use App\Domain\Spielfeld\Spielfeld;
use ReflectionClass;

class GenerateDomainMogelzettel implements MogelzettelGenerator
{

    public function __invoke(Spielfeld $spielfeld): Mogelzettel
    {
        $mogelzettel = new Mogelzettel($spielfeld->getSize(), $spielfeld->getListOfPositionsWithMine());

        $ro = new ReflectionClass($spielfeld);
        $prop = $ro->getProperty('grid');
        $prop->setAccessible(true);

        $grid = $prop->getValue($spielfeld);

        $size = count($grid);
        for ($r = 0; $r < $size; $r++) {
            for($c = 0; $c < $size; $c++) {
                $spielfeldPos = $grid[$c][$r];
                if ($spielfeldPos->getFeld() instanceof FreiesFeld) {
                    $mogelzettel->getGrid()[$c][$r]->getFeld()->setMineCount($this->countMinesInNeighbourhood($r, $c, $grid));
                }
            }
        }

        return $mogelzettel;
    }

    private function countMinesInNeighbourhood(int $row, int $column, array $grid)
    {
        $mineCountOfNeighbours = 0;

        if($this->leftFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        if($this->leftTopFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        if($this->topFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        if($this->topRightFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        if($this->rightFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        if($this->rightBottomFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        if($this->bottomFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        if($this->bottomLeftFieldHasMine($row, $column, $grid)) {
            $mineCountOfNeighbours++;
        }

        return $mineCountOfNeighbours;
    }

    private function leftFieldHasMine(int $row, int $column, array $grid): bool
    {
        if($column-1 < 0) {
            return false;
        }

        if($grid[$column-1][$row]->getFeld() instanceof MinenFeld) {
            return true;
        }

        return false;
    }

    private function leftTopFieldHasMine(int $row, int $column, array $grid) {
        if($column-1 < 0 || $row-1 < 0) {
            return false;
        }

        if($grid[$column-1][$row-1]->getFeld() instanceof MinenFeld) {
            return true;
        }

        return false;
    }

    private function topFieldHasMine(int $row, $column, array $grid) {
        if($row-1 < 0) {
            return false;
        }

        if ($grid[$column][$row-1]->getFeld() instanceof MinenFeld) {
            return true;
        }

        return false;
    }

    private function topRightFieldHasMine(int $row, int $column, array $grid) {
        if($row-1 < 0 || $column+1 >= count($grid)) {
            return false;
        }

        if($grid[$column+1][$row-1]->getFeld() instanceof MinenFeld) {
            return true;
        }

        return false;
    }

    private function rightFieldHasMine(int $row, int $column, array $grid) {
        if($column+1 >= count($grid)) {
            return false;
        }

        if($grid[$column+1][$row]->getFeld() instanceof  MinenFeld) {
            return true;
        }

        return false;
    }

    private function rightBottomFieldHasMine(int $row, int $column, array $grid) {
        if($row+1 >= count($grid) || $column+1 >= count($grid)) {
            return false;
        }

        if($grid[$column+1][$row+1]->getFeld() instanceof MinenFeld) {
            return true;
        }

        return false;
    }

    private function bottomFieldHasMine(int $row, int $column, array $grid) {
        if($row+1 >= count($grid)) {
            return false;
        }

        if($grid[$column][$row+1]->getFeld() instanceof MinenFeld) {
            return true;
        }

        return false;
    }

    private function bottomLeftFieldHasMine(int $row, int $column, array $grid) {
        if($row+1 >= count($grid) || $column-1 < 0) {
            return false;
        }

        if($grid[$column-1][$row+1]->getFeld() instanceof MinenFeld) {
            return true;
        }

        return false;
    }


}