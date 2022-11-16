<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\EventInterface;
use App\Http\Validation\Event\StoreEventRequest as StoreValidation;
use App\Http\Validation\Event\UpdateEventRequest as UpdateValidation;

class EventController extends Controller
{
    private $repository;

    public function __construct(EventInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortField = $request->query('sort_field');
        $sortOrder = $request->query('sort_order');
        $search = $request->query('search', null);

        $isPaginated = $request->query('paginated', 1) == 1;
        if ($isPaginated) {
            $perPage = $request->query('per_page', 20);
            return $this->repository->getAllPaginated($perPage, $sortField, $sortOrder, $search);
        }

        return response()->json([
            'data' => $this->repository->getWithQuery($sortField, $sortOrder, $search),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeEvents(Request $request)
    {
        $sortField = $request->query('sort_field');
        $sortOrder = $request->query('sort_order');
        $search = $request->query('search', null);

        $isPaginated = $request->query('paginated', 1) == 1;
        if ($isPaginated) {
            $perPage = $request->query('per_page', 20);
            return $this->repository->getActiveEventsPaginated($perPage, $sortField, $sortOrder, $search);
        }

        return response()->json([
            'data' => $this->repository->getActiveEvents($sortField, $sortOrder, $search),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidation $request)
    {
        $this->generateSlug($request);

        return DB::transaction(function () use ($request) {
            $newData = $this->repository->create($request->all());

            return response()->json([
                'message' => 'Store Success',
                'data' => $newData,
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateValidation $request)
    {
        return DB::transaction(function () use ($request) {
            $this->repository->update($request->all(), $request->id);
            $updatedData = $this->show($request->id);

            return response()->json([
                'message' => 'Update Success',
                'data' => $updatedData,
            ]);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreValidation $request)
    {
        $this->generateSlug($request);

        return DB::transaction(function () use ($request) {
            $data = $this->repository->updateOrCreate($request->all(), $request->id);

            if ($data->wasRecentlyCreated) {
                return response()->json([
                    'message' => 'Create Success',
                    'data' => $data,
                ]);
            } else {
                $updatedData = $this->show($request->id);

                return response()->json([
                    'message' => 'Update Success',
                    'data' => $updatedData,
                ]);
            }

        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $deletedData = $this->show($request->id);
            $this->repository->delete($request->id);

            return response()->json([
                'message' => 'Delete Success',
                'data' => $deletedData,
            ]);
        });
    }

    private function generateSlug($request)
    {
        $request->merge([
            'slug' => strtolower(str_replace(' ', '-', $request->get('name')))
        ]);
    }
}
