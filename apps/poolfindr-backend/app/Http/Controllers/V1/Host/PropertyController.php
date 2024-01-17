<?php

namespace App\Http\Controllers\V1\Host;

use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\PropertyStoreRequest;
use App\Http\Requests\App\PropertyUpdateRequest;
use App\Http\Resources\App\PropertyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collection = QueryBuilder::for(Property::class)
            ->authenticatedHost()
            ->paginate($request->per_page);

        return PropertyResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyStoreRequest $request)
    {
        /** @var \App\Models\Host */
        $host = auth('host')->user();

        $property = $host->properties()->create($request->validated());

        return new PropertyResource($property);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyUpdateRequest $request, Property $property)
    {
        $property->update($request->validated());

        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([], Response::HTTP_OK);
    }
}
