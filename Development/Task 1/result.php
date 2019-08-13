<?php

abstract class FileLoader
{
    /**
     * @param string $filePath
     * @return integer[]
     */
    public static function process(string $filePath)
    {
        $content = static::parse(trim(file_get_contents($filePath)));
        return array_map('intval', $content);
    }

    /**
     * @param string $data
     * @return array
     */
    abstract protected static function parse(string $data): array;
}

class TXTFileLoader extends FileLoader
{
    /**
     * @inheritDoc
     */
    protected static function parse(string $data): array
    {
        return explode("\n", $data);
    }
}

class CSVFileLoader extends FileLoader
{
    /**
     * @inheritDoc
     */
    protected static function parse(string $data): array
    {
        return explode(",", $data);
    }
}


$data1 = TXTFileLoader::process(__DIR__ . '/file1.txt');
$data2 = CSVFileLoader::process(__DIR__ . '/file2.csv');



echo "The elements of file1.txt first and then the elements of file2.csv\r\n";
print_r($data1);
print_r($data2);

echo "The elements of both files in ascending order\r\n";
$data = array_merge($data1, $data2);
asort($data);
print_r($data);

echo "The intersection of the elements of both files\r\n";
$data = array_intersect($data1, $data2);
print_r($data);
