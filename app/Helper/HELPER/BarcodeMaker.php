<?php

namespace App\Helper\HELPER;

use Illuminate\Support\Str;
use Picqer\Barcode\Barcode;
use Picqer\Barcode\BarcodeGeneratorJPG;

class BarcodeMaker
{
    /**
     * @var string
     */
    private $tipoCodigo;
    /**
     * @var string
     */
    private $content;
    /**
     * @var Barcode
     */
    private $barCodeEngine;

    public function __construct($tipoCodigo, $content)
    {
        $this->barCodeEngine = new BarcodeGeneratorJPG();
        $this->tipoCodigo = $this->setTypeCode($tipoCodigo);
        $this->content = $this->setContent($content);
    }

    private function setContent(string $content)
    {
        if($this->tipoCodigo === 'I25'){
            if(preg_match("/\D/",$content)
                && Str::contains($content,"{{")
                && Str::contains($content, "}}"))
            {
                return "000000000";
            }
        }

        return $content;
    }

    private function setTypeCode(string $codigo)
    {
        switch($codigo){
            case('C128'):
                return $this->barCodeEngine::TYPE_CODE_128;
                break;
            case('I25'):
                return $this->barCodeEngine::TYPE_INTERLEAVED_2_5;
                break;
            default:
                return 'C128';
                break;
        }
    }

    public function output_base64()
    {
        return base64_encode($this->barCodeEngine->getBarcode($this->content, $this->tipoCodigo, 1, 100 ));
    }
}
