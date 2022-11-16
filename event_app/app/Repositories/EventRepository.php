<?php

namespace App\Repositories;

use App\Models\Event as Model;
use App\Repositories\Interfaces\EventInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Collection\Collection;

class EventRepository extends BaseRepository implements EventInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function getActiveEventsPaginated($perPage, $sortField, $sortOrder, $search): LengthAwarePaginator
    {
        $fillable = $this->getFillable($sortField);
        $sortOrder = $sortOrder ?? 'asc';

        return $this->model
            ->isActive()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($fillable, $sortOrder)
            ->paginate($perPage);
    }

    public function getActiveEvents($sortField, $sortOrder, $search): Collection
    {
        $fillable = $this->getFillable($sortField);
        $sortOrder = $sortOrder ?? 'asc';

        return $this->model
            ->isActive()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($fillable, $sortOrder)
            ->get();
    }
}
