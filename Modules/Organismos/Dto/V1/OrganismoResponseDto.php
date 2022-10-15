<?php

namespace Modules\Organismos\Dto\V1;

use App\Dto\BaseDto;

class OrganismoResponseDto extends BaseDto
{
    protected $id ;
    protected $estado ;
    protected $fecReg ;
    protected $fecMod ;
    protected $descripcion ;
    protected $slug ;
    protected $cuit ;
    protected $munID;
    protected $calle ;
    protected $calleNumero ;
    protected $piso ;
    protected $torre ;
    protected $codigoPostal ;
    protected $situacionIva ;
    protected $codigoArea_1 ;
    protected $numeroTelefono_1 ;
    protected $codigoArea_2 ;
    protected $numeroTelefono_2 ;
    protected $email ;
    protected $ciudad ;
    protected $zonID ;

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return OrganismosResponseDto
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     * @return OrganismosResponseDto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecReg()
    {
        return $this->fecReg;
    }

    /**
     * @param mixed $fecReg
     * @return OrganismosResponseDto
     */
    public function setFecReg($fecReg)
    {
        $this->fecReg = $fecReg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecMod()
    {
        return $this->fecMod;
    }

    /**
     * @param mixed $fecMod
     * @return OrganismosResponseDto
     */
    public function setFecMod($fecMod)
    {
        $this->fecMod = $fecMod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     * @return OrganismosResponseDto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return OrganismosResponseDto
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * @param mixed $cuit
     * @return OrganismosResponseDto
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMunID()
    {
        return $this->munID;
    }

    /**
     * @param mixed $munID
     * @return OrganismosResponseDto
     */
    public function setMunID($munID)
    {
        $this->munID = $munID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param mixed $calle
     * @return OrganismosResponseDto
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCalleNumero()
    {
        return $this->calleNumero;
    }

    /**
     * @param mixed $calleNumero
     * @return OrganismosResponseDto
     */
    public function setCalleNumero($calleNumero)
    {
        $this->calleNumero = $calleNumero;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * @param mixed $piso
     * @return OrganismosResponseDto
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTorre()
    {
        return $this->torre;
    }

    /**
     * @param mixed $torre
     * @return OrganismosResponseDto
     */
    public function setTorre($torre)
    {
        $this->torre = $torre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * @param mixed $codigoPostal
     * @return OrganismosResponseDto
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSituacionIva()
    {
        return $this->situacionIva;
    }

    /**
     * @param mixed $situacionIva
     * @return OrganismosResponseDto
     */
    public function setSituacionIva($situacionIva)
    {
        $this->situacionIva = $situacionIva;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoArea1()
    {
        return $this->codigoArea_1;
    }

    /**
     * @param mixed $codigoArea_1
     * @return OrganismosResponseDto
     */
    public function setCodigoArea1($codigoArea_1)
    {
        $this->codigoArea_1 = $codigoArea_1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroTelefono1()
    {
        return $this->numeroTelefono_1;
    }

    /**
     * @param mixed $numeroTelefono_1
     * @return OrganismosResponseDto
     */
    public function setNumeroTelefono1($numeroTelefono_1)
    {
        $this->numeroTelefono_1 = $numeroTelefono_1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoArea2()
    {
        return $this->codigoArea_2;
    }

    /**
     * @param mixed $codigoArea_2
     * @return OrganismosResponseDto
     */
    public function setCodigoArea2($codigoArea_2)
    {
        $this->codigoArea_2 = $codigoArea_2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroTelefono2()
    {
        return $this->numeroTelefono_2;
    }

    /**
     * @param mixed $numeroTelefono_2
     * @return OrganismosResponseDto
     */
    public function setNumeroTelefono2($numeroTelefono_2)
    {
        $this->numeroTelefono_2 = $numeroTelefono_2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return OrganismosResponseDto
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param mixed $ciudad
     * @return OrganismosResponseDto
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZonID()
    {
        return $this->zonID;
    }

    /**
     * @param mixed $zonID
     * @return OrganismosResponseDto
     */
    public function setZonID($zonID)
    {
        $this->zonID = $zonID;
        return $this;
    }


}
