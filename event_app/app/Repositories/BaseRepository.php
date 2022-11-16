<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param $sortField
     * @param $sortOrder
     * @return Collection
     */
    public function getWithQuery($sortField, $sortOrder, $search): Collection
    {
        $fillable = $this->getFillable($sortField);
        $sortOrder = $sortOrder ?? 'asc';

        return $this->model
            ->orderBy($fillable, $sortOrder)
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->get();
    }

    /**
     * @param $perPage
     * @param $sortField
     * @param $sortOrder
     * @return LengthAwarePaginator
     */
    public function getAllPaginated($perPage, $sortField, $sortOrder, $search): LengthAwarePaginator
    {
        $fillable = $this->getFillable($sortField);
        $sortOrder = $sortOrder ?? 'asc';

        return $this->model
            ->orderBy($fillable, $sortOrder)
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->paginate($perPage);
    }

    /**
     * @param $id
     *
     * @return Model
     */
    public function find($id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $criteria
     *
     * @return Model
     */
    public function findByCriteria(array $criteria): ?Model
    {
        return $this->model
            ->where($criteria)
            ->first();
    }

    /**
     * @param array $criteria
     *
     * @return Collection
     */
    public function getByCriteria(array $criteria): Collection
    {
        return $this->model
            ->where($criteria)
            ->get();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     *
     * @return void
     */
    public function update(array $attributes, $id)
    {
        return $this->model
            ->where('id', $id)
            ->update($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     *
     * @return void
     */
    public function updateOrCreate(array $attributes, $id)
    {
        return $this->model
            ->updateOrCreate(
                ['id' => $id],
                $attributes,
            );
    }

    /**
     * @param $id
     *
     * @return void
     */
    public function delete($id)
    {
        return $this->model
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function getFillable($sortField): string
    {
        if ($sortField) {
            if (in_array($sortField, $this->model->getFillable(), true)) {
                return $sortField;
            }
        }

        return 'id';
    }

}
