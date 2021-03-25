<?php
declare(strict_types=1);

namespace App\Domain\Mogelzettel;


final class Mogelzettel
{
    private $grid;

    public function __construct(int $size, array $listOfPositionsWithMine) {

        $rows = [];
        for($j = 0; $j < $size; $j++) {

            $row = [];
            for ($i = 0; $i < $size; $i++) {
                $row[] = new MogelzettelPosition(new FreiesFeld());
            }
            $rows[] = $row;
        }

        $this->grid = $rows;

        $this->placeMines($listOfPositionsWithMine);

    }

    private function placeMines(array $listOfPositionsWithMine)
    {
        for ($i = 0; $i < count($listOfPositionsWithMine); $i++) {
            $mogelzettelPos = $this->grid
                        [$listOfPositionsWithMine[$i][0]]
                        [$listOfPositionsWithMine[$i][1]];
            $mogelzettelPos->setFeld(new MinenFeld());
        }
    }

    public function getGrid(): array
    {
        return $this->grid;
    }
}