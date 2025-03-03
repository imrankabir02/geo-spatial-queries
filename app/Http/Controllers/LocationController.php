<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Requests\LocationRequest;
use MatanYadaev\EloquentSpatial\Objects\Point;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        // $location = Location::create($request->validated());
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::create([
            'name' => $request->name,
            'description' => $request->description,
            'coordinates' => (new Point($request->latitude, $request->longitude)),
        ]);

        return response()->json($location, 201);
    }

    public function nearby(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'distance' => 'required|numeric', // in meters
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $distance = $request->distance;

        // Find locations within specified distance
        $locations = Location::select('id', 'name', 'description', 'coordinates')
        ->whereRaw("ST_DWithin(
            coordinates::geography,
            ST_SetSRID(ST_Point(?, ?), 4326)::geography,
            ?
        )", [$longitude, $latitude, $distance])
        ->get();

        return response()->json($locations);
    }

    public function checkInGeofence(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // Find all geofences that contain this point
        $geofences = Geofence::whereRaw("ST_Contains(
            boundary,
            ST_SetSRID(ST_Point(?, ?), 4326)
        )", [$longitude, $latitude])
        ->get();

        return response()->json([
            'in_geofence' => $geofences->isNotEmpty(),
            'geofences' => $geofences
        ]);
    }
}
