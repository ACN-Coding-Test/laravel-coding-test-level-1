<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Repositories\Contracts\EventContract;

class EventController extends Controller
{
    /** @var $repository*/
    protected $repository;

    public function __construct(EventContract $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = $this->repository->all();
        
        return EventResource::collection($data);
    }

    public function active()
    {
        $data = $this->repository->active();

        return EventResource::collection($data);
    }

    public function show($id)
    {
        $data = $this->repository->find($id);

        return new EventResource($data);
    }

    public function store(EventRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $this->repository->store($request->all());

            return new EventResource($data); 
        });
    }

    public function update(EventRequest $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $this->repository->update($request->all(), $id);
        
            return response()->json([
                'status' => 'success',
                'message' => 'Event updated successfully',
            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $this->repository->delete($id);
        
            return response()->json([
                'status' => 'success',
                'message' => 'Event deleted successfully',
            ]);
        });
    }
}
