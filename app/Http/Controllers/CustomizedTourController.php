<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageInclusion;
use App\Models\PackageRoute;
use Illuminate\Http\Request;

class CustomizedTourController extends Controller
{

    public function store_custom_tour(Request $request)
    {
        // Validate the request data
        $request->validate([
            'days' => 'required|integer|min:0',
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'exists:inclusions,id',
            'air_ticket' => 'required|exists:air_tickets,id',
            'departure' => 'required|exists:dipartures,id',
            'requests' => 'nullable|string',
            'destination' => 'required|string', // Ensure destination is provided
        ]);

        // Create a new package
        $package = new Package();
        $package->user_id = auth()->id();
        $package->type = 'custom';
        $package->status = 'pending';
        $package->category_id = $request->category_id;
        $package->air_ticket_id = $request->air_ticket;
        $package->departure_id = $request->departure;
        $package->no_of_days = $request->days;
        $package->requests = $request->requests;

        // Save the package
        $package->save();

        // Parse the selected route IDs from the hidden input
        $routeIds = explode(',', $request->destination);

        // Save each route ID in the packageroute table
        foreach ($routeIds as $routeId) {
            PackageRoute::create([
                'package_id' => $package->id,
                'route_id' => $routeId,
            ]);
        }

        // Save each inclusion ID in the packageinclusion table if any
        if ($request->inclusions) {
            foreach ($request->inclusions as $inclusionId) {
                PackageInclusion::create([
                    'package_id' => $package->id,
                    'inclusion_id' => $inclusionId,
                ]);
            }
        }

        // Redirect or return a response
        return redirect()->back()->with('success', 'Custom tour package created successfully.');
    }



}
