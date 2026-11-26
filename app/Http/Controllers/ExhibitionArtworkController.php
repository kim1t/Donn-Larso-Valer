<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExhibitionArtwork;

class ExhibitionArtworkController extends Controller
{
    public function index()
    {
        $links = ExhibitionArtwork::all();

        return response()->json([
            'message' => 'Exhibition artworks retrieved successfully',
            'data' => $links
        ], 200);
    }

    public function show($id)
    {
        $link = ExhibitionArtwork::find($id);

        if (!$link) {
            return response()->json([
                'message' => 'Exhibition artwork not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Exhibition artwork retrieved successfully',
            'data' => $link
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'exhibition_id' => 'required|exists:exhibitions,id',
            'artwork_id' => 'required|exists:artworks,id|unique:exhibition_artwork,artwork_id,NULL,id,exhibition_id,' . $request->exhibition_id
        ]);

        $link = ExhibitionArtwork::create($validated);

        return response()->json([
            'message' => 'Artwork added to exhibition successfully',
            'data' => $link
        ], 201);
    }

    public function destroy($id)
    {
        $link = ExhibitionArtwork::find($id);

        if (!$link) {
            return response()->json([
                'message' => 'Exhibition artwork not found'
            ], 404);
        }

        $link->delete();

        return response()->json([
            'message' => 'Artwork removed from exhibition successfully'
        ], 200);
    }
}
