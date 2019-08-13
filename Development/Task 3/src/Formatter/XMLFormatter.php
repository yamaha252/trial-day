<?php

namespace Formatter;

/**
 * Class XMLFormatter
 * @package Formatter
 */
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
        $xml = new \SimpleXMLElement('<root/>');
        foreach ($data as $item) {
            $xml->addChild('id', $item->getId());
            $xml->addChild('name', $item->getName());
            $xml->addChild('company', $item->getCompany());
            $xml->addChild('description', $item->getDescription());
        }
        return $xml->asXML();
    }
}
