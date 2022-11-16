<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Collection\Collection;

interface EventInterface {

    public function getActiveEventsPaginated($perPage, $sortField, $sortOrder, $search): LengthAwarePaginator;

    public function getActiveEvents($sortField, $sortOrder, $search): Collection;
}
