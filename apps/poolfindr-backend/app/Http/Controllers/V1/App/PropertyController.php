<?php

namespace App\Http\Controllers\V1\App;

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
            ->paginate($request->per_page);

        return PropertyResource::collection($collection);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }
}
