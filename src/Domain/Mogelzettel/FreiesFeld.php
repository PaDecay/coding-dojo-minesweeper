<?php
declare(strict_types=1);

namespace App\Domain\Mogelzettel;


use App\Domain\Mogelzettel\ValueObject\MineCountOfNeighbours;

final class FreiesFeld implements Feld
{
    private MineCountOfNeighbours $count;

    public function __construct()
    {
        $this->count = new MineCountOfNeighbours(0);
    }

    public function setMineCount(int $count)
    {
        $this->count = new MineCountOfNeighbours($count);
    }

    public function getCount(): MineCountOfNeighbours //reflection stat getter?
    {
        return $this->count;
    }
}