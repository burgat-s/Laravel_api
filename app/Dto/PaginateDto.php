<?php

namespace App\Dto;

use App\Dto\BaseDto;

class PaginateDto extends BaseDto
{
    protected $current_page;
    protected $per_page;
    protected $data;
    protected $total;

    public function __construct(\Illuminate\Pagination\LengthAwarePaginator $objPaginador = null, array $dto = [])
    {
        if($objPaginador){
            $data = [
                'current_page' => $objPaginador->currentPage(),
                'per_page' => $objPaginador->perPage(),
                'data' => $dto,
                'total' => $objPaginador->total()
            ];
            $this->fill($data);
        }
    }

    public function getData(){
        return $this->data;
    }

}
