<?php

namespace App\Helper\HELPER;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFMaker
{
    private Dompdf $domPDF;

    private string $nombrePDF;
    private string $contentHTML;
    private string $contentCSS;
    private string $estiloHoja;

    public function __construct(string $HTML, string $CSS, string $tamaño)
    {
        $this->contentHTML = $HTML;
        $this->contentCSS = $CSS;
        $this->estiloHoja = $tamaño;

        $this->nombrePDF = uniqid("PDF_",true);
        $this->settearDOMPDF();

    }

    private function settearDOMPDF()
    {
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setDpi(72);

        $htmlForDOMPDF = "<html><style>{$this->contentCSS} @page { margin: 0 }</style><body>{$this->contentHTML}</body></html>";

        $this->domPDF = new Dompdf();
        $this->domPDF->setOptions($options);
        $this->domPDF->loadHtml($htmlForDOMPDF);

        $this->domPDF->setPaper($this->estiloHoja);
    }

    public function setNombre(string $nombre)
    {
        $this->nombrePDF = $nombre;
    }

    public function makePDF()
    {
        $this->domPDF->render();
        return $this->domPDF->output();
    }

    public function makeStreamPDF()
    {
        $this->domPDF->render();
        return $this->domPDF->stream($this->nombrePDF);
    }
}
