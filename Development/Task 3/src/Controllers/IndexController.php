<?php

namespace Controllers;

use Export;

class IndexController
{
    /**
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \UndefinedConfigParam
     */
    function exportPage()
    {
        $success = false;
        if (!empty($_POST['format'])) {
            $export = new Export($_POST['format']);

            if (!empty($_POST['email'])) {
                $export->sendToEmail($_POST['email']);
                $success = true;
            } else {
                $export->export();
            }
        }

        return [
            'success' => $success,
            'formats' => [
                \ExportFormat::CSV => 'CSV file',
                \ExportFormat::XML => 'XML file',
                \ExportFormat::XML_SHORT => 'XML file with short descriptions',
            ]
        ];
    }
}
