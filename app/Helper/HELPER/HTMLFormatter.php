<?php

namespace App\Helper\HELPER;

use App\Entities\Eloquent\EpagosFormaPago;

trait HTMLFormatter
{
    function obtenerSRCs($html)
    {
        $resultados = [];
        //Dónde saqué el regex
        //https://stackoverflow.com/questions/450108/regular-expression-to-extract-src-attribute-from-img-tag
        preg_match_all("/src\s*=\s*\"(.+?)\"/", $html, $resultados);
        return $resultados;
    }

    /**
     *  La array debe ser de tipo key: variable , valor: dato:
     *  <code>
     *  $array = array(
     *    'variable1'      => 'dato1',
     *    'variable2'      => 'dato2',
     *  );
     *
     *  </code>
     *
     * @var array[string]string $datos
     * @var string $html
     */
    function reemplazarVariablesPorDatos(array $datos, string $html)
    {
        foreach ($datos as $variable => $dato) {
            $html = preg_replace("/{{{$variable}}}/i", $dato, $html);
        }
        return $html;
    }

    /**
     * @param string|array $link
     * @param \Closure $converter
     * @return array
     */
    function convertirURLaBase64($link, \Closure $converter, ?EpagosFormaPago $formasPago = null)
    {
        if (is_array($link)) {
            $resultado = [];
            foreach ($link as $value) {
                $resultado[count($resultado)] = $converter($value, $formasPago);
            }
            return $resultado;
        }
        if (is_string($link)) {
            return [$converter($link, $formasPago)];
        }
        throw new \InvalidArgumentException("Los argumentos no son válidos");
    }

    function reemplazarLinkPorBase64(array $atributos, array $conversionesBase64, string $html)
    {
        foreach ($atributos as $index => $src) {
            if (\Str::startsWith($src, "src=\"http")) continue; //Enlaces externos no los modifica
            $html = str_replace("{$src}", "src=\"data:image/png;base64,{$conversionesBase64[$index]}\"", $html); //Reemplazo el src relativo a absoluto
        }
        return $html;
    }

    /**
     * Serie de procesos de conversión de HTML a PDF
     * Usar solamente si sigue la misma cadena, usar los metodos singulares de arriba.
     *
     * @param array $datos [$variable => $dato]
     * @param \Closure $converter Función que convierta el Link a Base64.
     * @param string $html HTML a convertir
     * @return string
     */
    function procesarHTMLparaPDF(array $datos, \Closure $converter, string $html, ?EpagosFormaPago $formasPago = null)
    {
        $html = $this->reemplazarVariablesPorDatos($datos, $html);
        list($atributosConSRC, $SRCs) = $this->obtenerSRCs($html);
        $reemplazosA64 = $this->convertirURLaBase64($SRCs, $converter, $formasPago);
        $html = $this->reemplazarLinkPorBase64($atributosConSRC, $reemplazosA64, $html);
        return $html;
    }
}
