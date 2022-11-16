<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param $sortField
     * @param $sortOrder
     * @return Collection
     */
    public function getWithQuery($sortField, $sortOrder, $search): Collection;

    /**
     * @param $perPage
     * @param $sortField
     * @param $sortOrder
     * @return LengthAwarePaginator
     */
    public function getAllPaginated($perPage, $sortField, $sortOrder, $search): LengthAwarePaginator;

    /**
     * @param $id
     *
     * @return Model
     */
    public function find($id): Model;

    /**
     * @param array $criteria
     *
     * @return Model
     */
    public function findByCriteria(array $criteria): ?Model;

    /**
     * @param array $criteria
     *
     * @return Collection
     */
    public function getByCriteria(array $criteria): Collection;

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): ?Model;

    /**
     * @param $id
     * @param array $attributes
     *
     * @return void
     */
    public function update(array $attributes, $id);

    /**
     * @param $id
     * @param array $attributes
     *
     * @return void
     */
    public function updateOrCreate(array $attributes, $id);

    /**
     * @param $id
     *
     * @return void
     */
    public function delete($id);

    /**
     * @param $sortField
     *
     * @return string
     */
    public function getFillable($sortField): string;
}
