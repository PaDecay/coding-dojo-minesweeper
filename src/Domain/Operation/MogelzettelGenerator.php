<?php
declare(strict_types=1);

namespace App\Domain\Operation;


use App\Domain\Mogelzettel\Mogelzettel;
use App\Domain\Spielfeld\Spielfeld;

interface MogelzettelGenerator
{
    public function __invoke(Spielfeld $spielfeld): Mogelzettel;
}