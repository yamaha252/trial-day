<?php

namespace Formatter;

use Model\Job;

/**
 * Interface Formatter
 * @package Formatter
 */
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
