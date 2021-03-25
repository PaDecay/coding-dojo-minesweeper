<?php
declare(strict_types=1);

namespace App\Infrastructure\Command;


use App\Application\GenerateMogelzettel;
use App\Infrastructure\SaveResultAsTextFile;
use App\Infrastructure\GenerateMogelzettelCommandFromTextFile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateMogelzettelCLICommand extends Command
{
    protected static $defaultName = 'app:generate-mogelzettel';

    private GenerateMogelzettel $generateMogelzettel;
    private GenerateMogelzettelCommandFromTextFile $commandFromTextFile;
    private SaveResultAsTextFile $saveResultAsTextFile;

    public function __construct(string $name = null,
                                GenerateMogelzettel $createMogelzettel,
                                GenerateMogelzettelCommandFromTextFile $commandFromTextFile,
                                SaveResultAsTextFile $createMogelzettelAsTextFile)
    {
        $this->generateMogelzettel = $createMogelzettel;
        $this->commandFromTextFile = $commandFromTextFile;
        $this->saveResultAsTextFile = $createMogelzettelAsTextFile;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->addArgument('txt file', InputArgument::REQUIRED);

        parent::configure();

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('txt file');
        $command = ($this->commandFromTextFile)($fileName);
        ($this->generateMogelzettel)($command);

        return Command::SUCCESS;
    }
}