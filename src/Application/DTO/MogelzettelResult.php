<?php
declare(strict_types=1);

namespace App\Application\DTO;


final class MogelzettelResult
{
    private int $size;
    private array $listOfPositionsWithMine;
    private array $listOfPositionsWithMineCount;

    public function __construct(int $size, array $listOfPositionsWithMine, array $listOfPositionsWithMineCount)
    {
        $this->size = $size;
        $this->listOfPositionsWithMine = $listOfPositionsWithMine;
        $this->listOfPositionsWithMineCount = $listOfPositionsWithMineCount;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getListOfPositionsWithMine(): array
    {
        return $this->listOfPositionsWithMine;
    }

    public function getListOfPositionsWithMineCount(): array
    {
        return $this->listOfPositionsWithMineCount;
    }
}