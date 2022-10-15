<?php

namespace App\Helper\HELPER;

use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;

class QrMaker
{
    /**
     * @var string
     */
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function creacionQr($variable)
    {
        $writer = new PngWriter;
        $qr = QrCode::create($variable)
            ->setSize(200);

        return $writer->write($qr)->getString();
    }

    public function output_qr_base64()
    {
        return base64_encode($this->creacionQr($this->content));
    }
}
