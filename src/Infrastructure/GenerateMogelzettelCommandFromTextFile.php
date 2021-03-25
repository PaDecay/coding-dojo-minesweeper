<?php
declare(strict_types=1);

namespace App\Infrastructure;


use App\Application\DTO\GenerateMogelzettelCommand;

final class GenerateMogelzettelCommandFromTextFile
{
    private const MINE = '*';

    public function __invoke(string $fileName): GenerateMogelzettelCommand
    {
        $fileContent = file_get_contents($fileName);
        $rows = explode(PHP_EOL, $fileContent);

        $size = count($rows);
        $listOfPositionsWithMine = [];

        for($r = 0; $r < $size; $r++) {
            for($c = 0; $c < strlen($rows[$r]); $c++) {
                if($rows[$r][$c] === self::MINE) {
                    $listOfPositionsWithMine[] = [$c, $r];
                }
            }
        }

        return new GenerateMogelzettelCommand($size, $listOfPositionsWithMine);
    }
}