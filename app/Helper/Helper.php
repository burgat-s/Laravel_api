<?php
/**
 * Project: safit
 * File:    Helper.php
 * Date:    2019 - 11 - 29
 * Time:    16:56
 *
 * @author           Jorge Leonardo Ramirez Montoya <lramirez@sugit.com.ar>
 * @version          2019
 *
 */


namespace App\Helper;


use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\DeclareDeclare;

/**
 * Class Helper
 *
 * esta clase debe contener solo metodos estaticos que puedan ser re utilizados en cualquier lugar del sistema
 *
 * @package App\Helpers
 */
final class Helper
{
    const SESSION_SUCCESS_MESSAGE = 'success';
    const SESSION_WARNING_MESSAGE = 'warning';
    const SESSION_INFO_MESSAGE = 'info';
    const SESSION_ERROR_MESSAGE = 'error';
    const UNAUTHENTICATED_MESSAGE = 'Unauthenticated.';

    public static function generateToken()
    {
        return Str::random(80) . now()->timestamp;
    }

    public static function generateClient()
    {
        return now()->timestamp;
    }

    /**
     * Transformamos una fecha YYYY-MM-DD a DD-MM-YYYY
     * @param $fecha
     * @return Carbon
     */
    public static function formatearFechaFront(Carbon $fecha)
    {
        return $fecha->copy()->format('d-m-Y');
    }

    /**
     * Transformamos una fecha DD-MM-YYYY a YYYY-MM-DD
     * @param $fecha
     * @return Carbon
     */
    public static function formatearFechaBack($fecha)
    {
        $fechaCarbon = new Carbon($fecha);
        return $fechaCarbon->format('d-m-Y');
    }

    public static function getEnumSexo()
    {
        return config('enum.sexo');
    }

    public static function getEnumTraEstado()
    {
        return config('enum.traEstado');
    }

    public static function getEnumFrmEstado()
    {
        return config('enum.frmEstado');
    }

    public static function getEnumReiEstado()
    {
        return config('enum.reiEstado');
    }

    public static function getEnumReiRespuesta()
    {
        return config('enum.reiRespuesta');
    }

    public static function getEnumFiltrosSexo()
    {
        return config('enum.filtros.sexo');
    }

    public static function getEnumEstadoReincidencias()
    {
        return config('enum.filtros.estadoReincidencias');
    }

    public static function getEnumRespuestaReincidencias()
    {
        return config('enum.filtros.respuestaReincidencias');
    }

    public static function getEnumEstadoFormularios()
    {
        return config('enum.filtros.estadoFormularios');
    }

    public static function getEnumOrigen()
    {
        return config('enum.filtros.origen');
    }

    public static function getEnumMetodo()
    {
        return config('enum.filtros.metodo');
    }

    public static function getEnumRespuestaInformeConsultas()
    {
        return config('enum.filtros.respuestaInformeConsultas');
    }

    public static function getEnumEstadoTramites()
    {
        return config('enum.filtros.estadoTramites');
    }

    public static function getEnumTipoJuzgados()
    {
        return config('enum.filtros.tipoJuzgados');
    }

    public static function getEnumEstadoJuzgados()
    {
        return config('enum.filtros.estadoJuzgados');
    }

    public static function getEnumEstadoFaqs()
    {
        return config('enum.filtros.estadoFaqs');
    }

    public static function getStorage()
    {
        return config('enum.storage');
    }

    public static function getStorageInternal()
    {
        return config('enum.storage.internal');
    }

    public static function quitarTildes($cadena)
    {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
    }

    public static function espaciosPorGuiones($cadena)
    {
        return str_replace(" ", "-",$cadena);
    }

    public static function bytesToKB($size)
    {
        //TODO en caso de q sea 0 podemos devolver 1 porq redondea para abajo
        return (int)round($size/1024);
    }

    /**
     * Array completo de payload de assets
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function getAssetsPayload()
    {
        return config('app.assets_payload');
    }

    public static function getAssetsUrl()
    {
        return config('app.assets_url');
    }

    public static function escaparCaracteresEspeciales($data)
    {
        if(is_array($data))
        {
            $respuesta = [];
            foreach ($data as $key => $value) {
                $respuesta[$key] = addslashes($value);
            }
            return $respuesta;
        } else {
            return addslashes($data);
        }
    }


    public static function quitarComillasSimples($data)
    {
        if(is_array($data))
        {
            $respuesta = [];
            foreach ($data as $key => $value) {
                $respuesta[$key] = str_replace("'","%",$value);
            }
            return $respuesta;
        } else {
            return addslashes($data);
        }
    }

    public static function getEntorno()
    {
        return config('app.env');
    }


    public static function getFileServer()
    {
        return env('EMPSAT_FILE_SERVER', null);
    }

    public static function addZerosLeft(string $input, int $length = 2)
    {
        return str_pad($input, $length, '0', STR_PAD_LEFT);
    }

    public static function addZeros($data)
    {
        $columnas = Helper::columnsToAddZeros();

        foreach ($data->items() as $key => $value) {
            foreach ($columnas as $v){
                $columna = $v["columna"];

                if (property_exists($value,$columna)) {
                    $value->$columna = str_pad($value->$columna, $v["cant_zeros"], 0, STR_PAD_LEFT);
                }
            }
        }
        return $data;
    }

    private static function columnsToAddZeros(){

        return
            [
                [
                    "columna"=>"provincia_id",
                    "cant_zeros"=>config('safit.provincia_length')
                ],
                [
                    "columna"=>"municipalidad_id",
                    "cant_zeros"=>config('safit.municipalidad_length')
                ],
                [
                    "columna"=>"centro_emision_id",
                    "cant_zeros"=>config('safit.centro_emision_length')
                ]
            ];

    }



    public static function getFiltrosOperadores()
    {
        return config('filtros.filtrosOperadores');
    }

    public static function formatSexo($data)
    {
        foreach ($data->items() as $key => $value) {
            if (property_exists($value,"sexo")) {
                if ($value->sexo == "F")
                {
                    $value->sexo = "Femenino";
                }
                elseif ($value->sexo == "M")
                {
                    $value->sexo = "Masculino";
                }
                elseif ($value->sexo == "X")
                {
                    $value->sexo = "No Binario";
                }
            }
        }
        return $data;

    }

    public static function getEnumEstadoOperadores()
    {
        return config('enum.filtros.estadoOperadores');
    }



    public static function addZerosQuery($data)
    {
        $columnas = Helper::columnsToAddZeros();
        foreach ($data->getAttributes() as $key => $value) {

            foreach ($columnas as $v){
                $columna = $v["columna"];

                if ($key == $columna) {

                    $data->$columna = str_pad($data->$columna, $v["cant_zeros"], 0, STR_PAD_LEFT);
                }
            }
        }

        return $data;
    }

    public static function setupSexo()
    {
        $data =[
            [
                'value' => 'F',
                'label' => "Femenino"
            ],
            [
                'value' => 'M',
                'label' => "Masculino"
            ],
            [
                'value' => 'X',
                'label' => "No Binario"
            ]
        ];
        return $data;

    }

    public static function getFrontForgotUrl($urlFront,$path,$token)
    {
        return $urlFront.$path."?token=$token";
    }

    public static function getFrontLoginUrl($urlFront)
    {
        return $urlFront."/auth/login";
    }


}
