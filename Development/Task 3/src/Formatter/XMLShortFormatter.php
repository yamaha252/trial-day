<?php

namespace Formatter;

use Model\Job;

/**
 * Class XMLShortFormatter
 * @package Formatter
 */
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
