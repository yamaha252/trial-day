<?php

namespace Formatter;

/**
 * Class CSVFormatter
 * @package Formatter
 */
class CSVFormatter implements Formatter
{
    /**
     * @inheritDoc
     */
    public static function getExtension(): string
    {
        return 'csv';
    }

    /**
     * @inheritDoc
     */
    public static function getMimeType(): string
    {
        return 'text/csv';
    }

    /**
     * @inheritDoc
     */
    public static function process($data): string
    {
        $file = fopen('php://memory', 'r+');
        foreach ($data as $item) {
            fputcsv($file, [
                $item->getId(),
                $item->getName(),
                $item->getCompany(),
                $item->getDescription()
            ]);
        }
        rewind($file);
        $result = stream_get_contents($file);
        return rtrim($result);
    }
}
