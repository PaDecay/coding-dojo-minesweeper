<?php
declare(strict_types=1);

namespace App\Domain\Mogelzettel\ValueObject;


final class MineCountOfNeighbours
{
    private int $count;

    public function __construct(int $count)
    {
        if($count < 0) {
            $this->$count = 0;
        } else {
            $this->count = $count;
        }
    }

    public function asInt(): int
    {
        return $this->count;
    }
}