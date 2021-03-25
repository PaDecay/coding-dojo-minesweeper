<?php
declare(strict_types=1);

namespace App\Application;


use App\Application\DTO\GenerateMogelzettelCommand;
use App\Domain\Spielfeld\Spielfeld;

final class GenerateMogelzettel
{
    private MogelzettelPersister $mogelzettelPersister;
    private GenerateDomainMogelzettel $generateDomainMogelzettel;
    private BuildResult $buildResult;

    public function __construct(MogelzettelPersister $persister,
                                GenerateDomainMogelzettel  $generateDomainMogelzettel,
                                BuildResult $buildResult)
    {
        $this->mogelzettelPersister = $persister;
        $this->generateDomainMogelzettel = $generateDomainMogelzettel;
        $this->buildResult = $buildResult;
    }

    public function __invoke(GenerateMogelzettelCommand $command): void
    {
        $spielfeld = new Spielfeld($command->getSize(), $command->getListOfPositionsWithMine());

        $mogelZettel = ($this->generateDomainMogelzettel)($spielfeld);

        $result = ($this->buildResult)($mogelZettel);
        ($this->mogelzettelPersister)($result);
    }
}