<?php
declare(strict_types=1);

namespace App\Application;


use App\Application\DTO\MogelzettelResult;

interface MogelzettelPersister
{
    public function __invoke(MogelzettelResult  $result): void;
}