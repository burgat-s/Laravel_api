<?php

namespace Modules\Organismos\Dto\V1;

use App\Dto\BaseDto;

class OrganismoDto extends BaseDto
{
    protected $id;
    protected $estado;
    protected $descripcion;
    protected $slug;
    protected $cuit;
    protected $calle;
    protected $calle_numero;
    protected $piso;
    protected $torre;
    protected $codigo_postal;
    protected $situacion_iva;
    protected $codigo_area_1;
    protected $numero_telefono_1;
    protected $codigo_area_2;
    protected $numero_telefono_2;
    protected $email;
    protected $ciudad;
    protected $municipalidad_id;
    protected $zona_id;
    protected $updated_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return OrganismoDto
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
     * @return OrganismoDto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
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
     * @return OrganismoDto
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
     * @return OrganismoDto
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
     * @return OrganismoDto
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;
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
     * @return OrganismoDto
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
        return $this->calle_numero;
    }

    /**
     * @param mixed $calle_numero
     * @return OrganismoDto
     */
    public function setCalleNumero($calle_numero)
    {
        $this->calle_numero = $calle_numero;
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
     * @return OrganismoDto
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
     * @return OrganismoDto
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
        return $this->codigo_postal;
    }

    /**
     * @param mixed $codigo_postal
     * @return OrganismoDto
     */
    public function setCodigoPostal($codigo_postal)
    {
        $this->codigo_postal = $codigo_postal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSituacionIva()
    {
        return $this->situacion_iva;
    }

    /**
     * @param mixed $situacion_iva
     * @return OrganismoDto
     */
    public function setSituacionIva($situacion_iva)
    {
        $this->situacion_iva = $situacion_iva;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoArea1()
    {
        return $this->codigo_area_1;
    }

    /**
     * @param mixed $codigo_area_1
     * @return OrganismoDto
     */
    public function setCodigoArea1($codigo_area_1)
    {
        $this->codigo_area_1 = $codigo_area_1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroTelefono1()
    {
        return $this->numero_telefono_1;
    }

    /**
     * @param mixed $numero_telefono_1
     * @return OrganismoDto
     */
    public function setNumeroTelefono1($numero_telefono_1)
    {
        $this->numero_telefono_1 = $numero_telefono_1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoArea2()
    {
        return $this->codigo_area_2;
    }

    /**
     * @param mixed $codigo_area_2
     * @return OrganismoDto
     */
    public function setCodigoArea2($codigo_area_2)
    {
        $this->codigo_area_2 = $codigo_area_2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroTelefono2()
    {
        return $this->numero_telefono_2;
    }

    /**
     * @param mixed $numero_telefono_2
     * @return OrganismoDto
     */
    public function setNumeroTelefono2($numero_telefono_2)
    {
        $this->numero_telefono_2 = $numero_telefono_2;
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
     * @return OrganismoDto
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
     * @return OrganismoDto
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMunicipalidadId()
    {
        return $this->municipalidad_id;
    }

    /**
     * @param mixed $municipalidad_id
     * @return OrganismoDto
     */
    public function setMunicipalidadId($municipalidad_id)
    {
        $this->municipalidad_id = $municipalidad_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZonaId()
    {
        return $this->zona_id;
    }

    /**
     * @param mixed $zona_id
     * @return OrganismoDto
     */
    public function setZonaId($zona_id)
    {
        $this->zona_id = $zona_id;
        return $this;
    }
}
