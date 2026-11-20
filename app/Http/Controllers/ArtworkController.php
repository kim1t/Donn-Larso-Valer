
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::all();

        return response()->json([
            'message' => 'Artworks retrieved successfully',
            'data' => $artworks
        ], 200);
    }

    public function show($id)
    {
        $artwork = Artwork::find($id);

        if (!$artwork) {
            return response()->json([
                'message' => 'Artwork not found.'
            ], 404);
        }

        return response()->json([
            'message' => 'Artwork retrieved successfully',
            'data' => $artwork
        ], 200);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'mixed_media' => 'required|string|max:255'
        ]);

        $artwork = Artwork::create($validated);
        return response()->json([
            'message' => 'Artwork created successfully',
            'data' => $artwork
        ],201);
    }

    public function update(Request $request, $id){
        $artwork = Artwork::find($id);

        if(!$artwork){
            return response()->json([
                'message' => 'Artwork not found'
            ], 404);
        }

        $validated = $request->validate([
            'mixed_media' => 'sometimes|required|string|max:255'
        ]);

        $artwork->update($validated);

        return response()->json([
            'message' => 'Artist updated successfully',
            'data'=> $artwork
        ], 200);
    }

    public function destroy($id){
        $artwork = Artwork::find($id);

        if(!$artwork){
            return response()->json([
                'message' => 'Artwork not found'
            ], 404);
        }

        $artwork->delete();

        return response()->json([
            'message' => 'Artwork deleted successfully'
        ], 200);
    }

}

