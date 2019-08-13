<?php


use Model\Job;

interface Formatter
{
    /**
     * @return string
     */
    static function getExtension(): string;

    /**
     * @return string
     */
    static function getMimeType(): string;

    /**
     * @param Job[] $data
     * @return string
     */
    static function process($data): string;
}

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

class XMLFormatter implements Formatter
{
    /**
     * @inheritDoc
     */
    public static function getExtension(): string
    {
        return 'xml';
    }

    /**
     * @inheritDoc
     */
    public static function getMimeType(): string
    {
        return 'application/xml';
    }

    /**
     * @inheritDoc
     */
    public static function process($data): string
    {
        $xml = new SimpleXMLElement('<root/>');
        foreach ($data as $item) {
            $xml->addChild('id', $item->getId());
            $xml->addChild('name', $item->getName());
            $xml->addChild('company', $item->getCompany());
            $xml->addChild('description', $item->getDescription());
        }
        return $xml->asXML();
    }
}

class XMLShortFormatter extends XMLFormatter
{
    /**
     * Max length of a description
     */
    const MAX_DESCRIPTION_LENGTH = 100;

    /**
     * @inheritDoc
     */
    public static function process($data): string
    {
        return parent::process(static::processDescriptions($data));
    }

    /**
     * @param Job[] $data
     * @return Job[]
     */
    private static function processDescriptions($data)
    {
        return array_map(function ($item) {
            /** @var Job $item */
            $description = $item->getDescription();
            if (strlen($description) > self::MAX_DESCRIPTION_LENGTH) {
                $item->setDescription(substr($description, 0, self::MAX_DESCRIPTION_LENGTH) . '...');
            }
            return $item;
        }, $data);
    }
}
