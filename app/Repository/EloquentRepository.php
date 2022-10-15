<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Pipeline;

/**
 * Class EloquentRepository
 * @package App\Repository
 */
class EloquentRepository implements RepositoryInterface
{
    public array $filters = [];

    const PER_PAGE = 10;

     /**
     * @var
     */
    protected $model;

    /**
     * @param Model $model
     *
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * @param $model
     * @return $this
     */
    public function setModel($model) {
        $this->model = $model;
        return $this;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id) {
        $model = $this->findOrFail($id);
        $model->update($data);
        return $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id){
        return $this->model->findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function firstOrFail($columns){
        return $this->model->firstOrFail($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->firstOrFail($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($attribute, $value, $columns = array('*')){

        return $this->model->where($attribute, '=', $value)->get($columns);

    }

    /**
     * @param array $attribute
     * @param array $columns
     * @return mixed
     */
    public function findFor($attributes, $columns = array('*')) {

        $model = $this->model->select("*");

        foreach ($attributes as $attribute => $value){
            $model->where($attribute, '=', $value);
        }

        return $model->first($columns);
    }

    public function index($request)
    {
        $query = $this->model->newQuery();
        return $this->aplicateFilters($request,$query);
    }

    public function aplicateFilters($request, $query)
    {
        $per_page = $request['per_page']?? self::PER_PAGE;
        if (isset($request['columna']) && isset($request['orden'])) {
            if ($request['orden'] ===  'descend') {
                $query->orderByDesc($request['columna']);
            } else {
                $query->orderBy($request['columna']);
            }
        } else {
            $query->orderByDesc('updated_at');
        }
        foreach ($request as $key => $val) {
            if(!in_array($key,['per_page','page','orden','columna'] )){
                $query->where($key,'like','%'.$val.'%');
            }
        }
        return app(Pipeline::class)
            ->send($query)
            ->through($this->filters)
            ->thenReturn()
            ->paginate($per_page);
    }

}
