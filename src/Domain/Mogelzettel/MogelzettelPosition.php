<?php
declare(strict_types=1);

namespace App\Domain\Mogelzettel;


final class MogelzettelPosition
{
    private Feld $feld;

    public function __construct(Feld $feld)
    {
        $this->feld = $feld;
    }

    public function getFeld(): Feld
    {
        return $this->feld;
    }

    public function setFeld(Feld $feld): void
    {
        $this->feld = $feld;
    }


}