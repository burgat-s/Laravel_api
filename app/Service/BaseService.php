<?php

namespace App\Service;

use App\Dto\PaginateDto;

abstract class BaseService
{
    protected $perPage = 15;
    protected $page = 1;
    const VERSION = 'v1';
    const PREFIX = 'base';

    protected  $modelRepository = null;
    protected  $modelDto = null;

    public function getAll($columns = array('*')): array
    {
        $collection = $this->modelRepository->all($columns);
        $data = [];
        foreach ($collection as $model) {
            $data[] = (new $this->modelDto())->fillCustom($model->toArray());
        }
        return $data;
    }

    public function index(array $request): PaginateDto
    {
        $collection = $this->modelRepository->index($request);
        $data = [];
        foreach ($collection as $model) {
            $data[] = new $this->modelDto($model->toArray());
        }
        return new PaginateDto($collection, $data);
    }

    public function show(int $id)
    {
        $model = $this->modelRepository->findOrFail($id);
        return new $this->modelDto($model->toArray());
    }

    public function store(array $request)
    {
        $model = $this->modelRepository->store($request);
        return (new $this->modelDto())->fillCustom(['id' => $model->id]);
    }

    public function update($id ,array $request)
    {
        $model = $this->modelRepository->update($id);
        return new $this->modelDto($model->toArray());
    }


}
