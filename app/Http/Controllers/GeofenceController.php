<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geofence;
use App\Models\Location;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class GeofenceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coordinates' => 'required|array',
            'coordinates.*' => 'required|array',
            'coordinates.*.*' => 'required|numeric',
        ]);

        $points = [];

        foreach ($request->coordinates as $coordinate) {
            $points[] = new Point($coordinate[1], $coordinate[0]);
        }

        if ($points[0]->getLat() !== end($points)->getLat() || $points[0]->getLng() !== end($points)->getLng())
        {
            $points[] = $points[0];
        }

        $linestring = new LineString($points);
        $polygon = new Polygon([$linestring]);

        $geofence = Geofence::create([
            'name' => $request->name,
            'description' => $request->description,
            'boundary' => new Polygon($polygon),
        ]);

        return response()->json($geofence, 201);
    }

    public function getLocationsInGeofence($geofence)
    {
        $geofence = Geofence::findOrFail($geofence);
        $locations = Location::select('id', 'name', 'description', 'coordinates')
            ->whereRaw("ST_Within(
                coordinates::geography,
                ST_GeomFromText(?)
            )", [$geofence->boundary->toWKT()])
            ->get();

        return response()->json($locations);
    }
}
