<?php

namespace Modules\Organismos\Http\Controllers\V1;

use App\Dto\ApiResponseDto;
use Illuminate\Routing\Controller;
use Modules\Organismos\Http\Requests\OrganismosStoreRequest;
use Modules\Organismos\Http\Requests\OrganismosUpdateRequest;
use Modules\Organismos\Services\V1\OrganismosService;
use Modules\Organismos\Http\Requests\OrganismosIndexRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrganismosController extends Controller
{
    /**
     * @var OrganismosService
     */
    private $organismosService;

    /**
     * @var ApiResponseDto
     */
    private $apiResponseDto;

    public function __construct(OrganismosService $organismosService,ApiResponseDto $apiResponseDto)
    {
        $this->organismosService = $organismosService;
        $this->apiResponseDto = $apiResponseDto;
    }

    public function getAll()
    {
        $result = $this->organismosService->getAll(['id','descripcion']);
        return $this->apiResponseDto->response(ResponseAlias::HTTP_OK , $result,(count($result)>0)? null :"No Datos para la busqueda");
    }

    public function index(OrganismosIndexRequest $request)
    {
        $result = $this->organismosService->index($request->validated());
        return $this->apiResponseDto->response(ResponseAlias::HTTP_OK , $result,(count($result->getData())>0)? null :"No hay resultados para la busqueda");
    }

    public function editEstado($id)
    {
        $result = $this->organismosService->editEstado($id);
        return $this->apiResponseDto->response(ResponseAlias::HTTP_OK,$result);
    }

    public function show($id)
    {
        $result  = $this->organismosService->show($id);
        return $this->apiResponseDto->response(ResponseAlias::HTTP_OK,$result);
    }

    public function store(OrganismosStoreRequest $request)
    {
        $result = $this->organismosService->store($request->validated());
        return $this->apiResponseDto->response(ResponseAlias::HTTP_CREATED,$result);
    }

    public function update(OrganismosUpdateRequest $request, $id)
    {
        $result = $this->organismosService->update($request->validated(), $id);
        return $this->apiResponseDto->response(ResponseAlias::HTTP_OK,$result);
    }


    public function showFolders($id)
    {
        $result   = $this->organismosService->showFolders($id);
        return $this->apiResponseDto->response(ResponseAlias::HTTP_OK,$result);
    }


}
