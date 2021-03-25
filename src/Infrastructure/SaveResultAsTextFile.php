<?php
declare(strict_types=1);

namespace App\Infrastructure;


use App\Application\DTO\MogelzettelResult;
use App\Application\MogelzettelPersister;

final class SaveResultAsTextFile implements MogelzettelPersister
{
    private const MINE = '*';

    public function __invoke(MogelzettelResult $result): void
    {
        $content = '';

        for($c = 0; $c < $result->getSize(); $c++) {
            for($r = 0; $r < $result->getSize(); $r++) {
                $content .= '0';
            }
            $content .= PHP_EOL;
        }

        for($i = 0; $i < count($result->getListOfPositionsWithMine()); $i++) {
            $content = $this->insertInTextFile($content, $result->getListOfPositionsWithMine()[$i][1], $result->getListOfPositionsWithMine()[$i][0],self::MINE);
        }

        for($i = 0; $i < count($result->getListOfPositionsWithMineCount()); $i++) {
            $content = $this->insertInTextFile($content, $result->getListOfPositionsWithMineCount()[$i][0][1], $result->getListOfPositionsWithMineCount()[$i][0][0], $result->getListOfPositionsWithMineCount()[$i][1]->asInt());
        }

        file_put_contents('mogelzettel', $content);
    }






    private function insertInTextFile($textFile, $row, $column, $char)
    {
        $rows = explode(PHP_EOL, $textFile);
        $rows[$row] = substr_replace($rows[$row], $char, $column, 1);

        return implode(PHP_EOL, $rows);
    }
}