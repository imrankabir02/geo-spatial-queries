<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    public function store(LocationRequest $request)
    {
        $location = Location::create($request->validated());

        return response()->json($location, 201);
    }

    public function nearby(Request $request)
    {
        $request->validate([
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'distance' => ['required', 'numeric'],
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $distance = $request->distance;

        $locations = Location::whereRaw("ST_DWithin([
            'coordinates::geography',
            ST_SRID(POINT(? , ?), 4326)::geography,
            ?,
        ])", [$latitude, $longitude, $distance])->get();

        return response()->json($locations);
    }
}
