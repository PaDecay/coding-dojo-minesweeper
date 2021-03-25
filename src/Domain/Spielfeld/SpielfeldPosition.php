<?php
declare(strict_types=1);

namespace App\Domain\Spielfeld;


final class SpielfeldPosition
{
    private Feld $feld;

    public function __construct(Feld $feld)
    {
        $this->feld = $feld;
    }

    public function getFeld(): Feld  // getter?
    {
        return $this->feld;
    }

    public function setFeld(Feld $feld): void
    {
        $this->feld = $feld;
    }

}