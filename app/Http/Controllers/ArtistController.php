<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    // function to handle requests to retrieve all artists data
    public function index(){
        $artists = Artist:: all();
        return response()->json([
            'message' => 'Artists retrieved successfully',
            'data' => $artists
        ], 200);
    }

    public function show($id){
        $artist = Artist::find($id);

        if(!$artist){
            return response()->json([
                'message' => 'Artist not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Artist retrieved successfully',
            'data' => $artist
        ], 200);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'avatar' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $artist = Artist::create($validated);
        return response()->json([
            'message' => 'Artist created successfully',
            'data' => $artist
        ],201);
    }

    public function update(Request $request, $id){
        $artist = Artist::find($id);

        if(!$artist){
            return response()->json([
                'message' => 'Artist not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'avatar' => 'sometimes|nullable|string',
        ]);

        $artist->update($validated);

        return response()->json([
            'message' => 'Artist updated successfully',
            'data'=> $artist
        ], 200);
    }

    public function destroy($id){
        $artist = Artist::find($id);

        if(!$artist){
            return response()->json([
                'message' => 'Artist not found'
            ], 404);
        }

        $artist->delete();

        return response()->json([
            'message' => 'Artist deleted successfully'
        ], 200);
    }
}
