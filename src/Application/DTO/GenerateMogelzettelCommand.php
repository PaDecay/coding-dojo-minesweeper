<?php
declare(strict_types=1);

namespace App\Application\DTO;


final class GenerateMogelzettelCommand
{
    private int $size;
    private array $listOfPositionsWithMine;

    public function __construct(int $size, array $list)
    {
        $this->size = $size;
        $this->listOfPositionsWithMine = $list;
    }

    public function getListOfPositionsWithMine(): array
    {
        return $this->listOfPositionsWithMine;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}