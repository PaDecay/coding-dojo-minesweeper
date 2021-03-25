<?php
declare(strict_types=1);

namespace App\Domain\Spielfeld;


final class Spielfeld
{
    private array $listOfPositionsWithMine;

    /** @var array<int, array<int, SpielfeldPosition>> */
    private array $grid;

    public function __construct(int $size, array $listOfPositionsWithMine) //position object?
    {
        $this->listOfPositionsWithMine = $listOfPositionsWithMine;

        $rows = [];
        for($j = 0; $j < $size; $j++) {
            $row = [];
            for ($i = 0; $i < $size; $i++) {
                $row[] = new SpielfeldPosition(new FreiesFeld());
            }
            $rows[] = $row;
        }
        $this->grid = $rows;
        $this->placeMines($listOfPositionsWithMine);
    }

    private function placeMines(array $listOfPositionsWithMine)
    {

        for ($c = 0; $c < count($listOfPositionsWithMine); $c++) {
            $spielfeldPos = $this->grid
                                [$listOfPositionsWithMine[$c][0]]
                                [$listOfPositionsWithMine[$c][1]];
            $spielfeldPos->setFeld(new MinenFeld());
        }
    }

    public function getSize(): int
    {
        return count($this->grid);
    }

    public function getListOfPositionsWithMine(): array
    {
        return $this->listOfPositionsWithMine;
    }
}