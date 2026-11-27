<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exhibition;
use Illuminate\Validation\Validator;

class ExhibitionController extends Controller
{
    public function index()
    {
        $exhibitions = Exhibition::all();

        return response()->json([
            'message' => 'Exhibitions retrieved successfully',
            'data' => $exhibitions
        ], 200);
    }

    public function show($id)
    {
        $exhibition = Exhibition::find($id);

        if (!$exhibition) {
            return response()->json([
                'message' => 'Exhibition not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Exhibition retrieved successfully',
            'data' => $exhibition
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'capacity' => 'required|integer|min:1',
            'art_gallery_id' => 'required|exists:art_galleries,id',
            'theme' => 'nullable|string|max:255'
        ]);

        $exhibition = Exhibition::create($validated);

        return response()->json([
            'message' => 'Exhibition created successfully',
            'data' => $exhibition
        ], 201);
    }

    
    public function update(Request $request, $id)
    {
        $exhibition = Exhibition::find($id);

        if (!$exhibition) {
            return response()->json([
                'message' => 'Exhibition not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date',
            'capacity' => 'sometimes|required|integer|min:1',
            'art_gallery_id' => 'sometimes|required|exists:art_galleries,id',
            'theme' => 'sometimes|nullable|string|max:255'
        ]);

        $startDate = $validated['start_date'] ?? $exhibition->start_date;
        $endDate = $validated['end_date'] ?? $exhibition->end_date;

        if ($endDate < $startDate) {
            return response()->json([
                'message' => 'End date cannot be before start date.'
            ], 422);
        }
        $exhibition->update($validated);

        return response()->json([
            'message' => 'Exhibition updated successfully',
            'data' => $exhibition
        ], 200);
    }


    public function destroy($id)
    {
        $exhibition = Exhibition::find($id);

        if (!$exhibition) {
            return response()->json([
                'message' => 'Exhibition not found'
            ], 404);
        }

        $exhibition->delete();

        return response()->json([
            'message' => 'Exhibition deleted successfully'
        ], 200);
    }
}
