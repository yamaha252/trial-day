<?php

use Formatter\CSVFormatter;
use Formatter\Formatter;
use Formatter\XMLFormatter;
use Formatter\XMLShortFormatter;
use Model\Job;
use PHPMailer\PHPMailer\PHPMailer;

class ExportType
{
    /**
     * Full CSV
     */
    const CSV = 'csv';

    /**
     * Full XML
     */
    const XML = 'xml';

    /**
     * XML short description
     */
    const XML_SHORT = 'xmls';
}

class Export
{
    /**
     * @var Formatter[]
     */
    private $formatters = [
        ExportType::CSV => CSVFormatter::class,
        ExportType::XML => XMLFormatter::class,
        ExportType::XML_SHORT => XMLShortFormatter::class,
    ];

    /**
     * @var Formatter
     */
    private $formatter;

    public function __construct(string $type)
    {
        $this->formatter = $this->formatters[$type];
    }

    /**
     * Return file as attachment
     * @throws \Doctrine\ORM\ORMException
     * @throws UndefinedConfigParam
     */
    function export()
    {
        header('Content-Disposition: attachment; filename=' . $this->getFileName());
        header('Content-Type: ' . $this->getMimeType());
        echo $this->getContent();
        exit;
    }

    function sendToEmail(string $email)
    {
        $mail = new PHPMailer(true);
        $mail->addAddress($email);
        $mail->setFrom('somebody@trialday.com');
        $mail->Subject = 'Export is done';
        $mail->Body = "Hello! \r\n You can find the exported file in the attachments";
        $mail->addStringAttachment($this->getContent(), $this->getFileName(), PHPMailer::ENCODING_BASE64, $this->getMimeType());
        $mail->send();
    }

    /**
     * @return Job[]
     * @throws \Doctrine\ORM\ORMException
     * @throws UndefinedConfigParam
     */
    private function getData()
    {
        $repository = Connection::getEntityManager()->getRepository(Job::class);
        return $repository->findAll();
    }

    /**
     * @return string
     */
    private function getFileName(): string
    {
        return 'export.' . $this->formatter::getExtension();
    }

    /**
     * @return string
     */
    private function getMimeType(): string
    {
        return $this->formatter::getMimeType();
    }

    /**
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws UndefinedConfigParam
     */
    private function getContent(): string
    {
        $data = $this->getData();
        return $this->formatter::process($data);
    }
}
