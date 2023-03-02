<?php
namespace App\Contracts;

interface CsvGeneratorInterface
{
    // public function generateCsvFile(array $data, string $filename): bool;
    public function generateCSV($orders);
}
