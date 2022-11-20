<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\Pure;
use Illuminate\Contracts\Database\Query\Builder;

abstract class Repository
{
    protected Model $model;
    // public $query; todo should make query
    protected int $default_per_page = 15;
    protected bool $default_paginate = true;

    abstract public function model(): string;

    abstract public function relations(): array;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    #[Pure] public function getFillable(): array
    {
        return $this->model->getFillable() ?? [];
    }

    public function queryByInputs(Builder $query, $inputs = []): Builder
    {
        if (!empty($inputs)) {
            foreach ($inputs as $keyInput => $valueInput) {
                if ((in_array($keyInput, $this->getFillable()) || $keyInput == 'id') && (is_string($valueInput) || is_int($valueInput))) {
                    $query = $this->by($query, $keyInput, $valueInput);
                }
            }
        }
        return $query;
    }

    public function queryByRelations(Builder $query, $relations = []): Builder
    {
        if (!empty($relations)  /*&& in_array($relations, $this->relations()) todo somethings wrong */) {
            $query = $query->with($relations);
        }

        return $query;
    }

    public function queryFull($inputs = [], $relations = [], $orderByColumn = 'id', $directionOrderBy = 'desc'): Builder
    {
        /** @var Builder $query */
        $query = $this->model->query();
        $query = $this->queryByInputs($query, $inputs);
        $query = $this->queryByRelations($query, $relations);
        return $this->orderBy($query, $orderByColumn, $directionOrderBy);
    }

    public function all($inputs = [], $relations = [], $orderByColumn = 'id', $directionOrderBy = 'desc'): Collection
    {
        return $this->queryFull($inputs, $relations, $orderByColumn, $directionOrderBy)->get();
    }

    public function orderBy(Builder $query, $orderByColumn = 'id', $directionOrderBy = 'desc'): Builder
    {
        return $query->orderBy($orderByColumn, $directionOrderBy);
    }

    public function paginate($perPage = null, $inputs = [], $relations = [], $orderByColumn = 'id', $directionOrderBy = 'desc')
    {
        $perPage = $perPage ?? request('per_page') ?? request('perPage') ?? $this->default_per_page;
        return $this->queryFull($inputs, $relations, $orderByColumn, $directionOrderBy)->paginate($perPage);
    }

    public function resolve_paginate($perPage = null, $inputs = [], $relations = [], $orderByColumn = 'id', $directionOrderBy = 'desc', $paginate = null): LengthAwarePaginator|Collection
    {
        $paginate =isset($paginate) && !is_bool($paginate) ? $paginate : request('paginate') ?? $this->default_paginate;
        $query =$this->queryFull($inputs, $relations, $orderByColumn, $directionOrderBy);
        return
            $paginate
                ?
                $query->paginate($perPage)
                :
                $query->get();
    }

    public function getBy($col, $value, $limit = 15)
    {
        return $this->model->where($col, $value)->limit($limit)->get();
    }

    public function by(Builder $query, $col, $value): Builder
    {
        return $query->where($col, $value);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($model, array $data)
    {
        return $model->update($data);
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function exists($id)
    {
        return $this->model->where($this->model->getKeyName(), $id)->exists();
    }
}
