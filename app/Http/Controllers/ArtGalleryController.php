<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtGallery;

class ArtGalleryController extends Controller
{
    //function to retrieve all art gallery data
    public function index(){
        $artgalleries = ArtGallery::all();

        return response()->json([
            'message' => 'Art galleries retrieved successfully',
            'data' => $artgalleries
        ], 200);
    }

    public function show($id){
        $artgallery = ArtGallery::find($id);

        if(!$artgallery){
            return response()-> json([
                'message'=> 'Art gallery not found'
            ], 404);
        }
        return response()-> json([
        'message'=> 'Art gallery retrieved successfully',
        'data'=> $artgallery
        ], 200);
        }

        public function store(Request $request){
            $validated = $request->validate([
                'name'=> 'required|string|max:255',
                'location' => 'nullable|string',
                'logo' => 'nullable|string',
            ]);

        $artgallery = ArtGallery::create($validated);

        return response()->json([
            'message' => 'Art gallery created successfully',
            'data' => $artgallery
        ],201);
    }

        public function update(Request $request, $id){
        $artgallery = ArtGallery::find($id);

        if(!$artgallery){
            return response()->json([
                'message' => 'Art gallery not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|nullable|string',
            'logo' => 'sometimes|nullable|string',
        ]);

        $artgallery->update($validated);
        return response()->json([
            'message' => 'Artist updated successfully',
            'data'=> $artgallery
        ], 200);
    }

    public function destroy($id){
        $artgallery = ArtGallery::find($id);

        if(!$artgallery){
            return response()->json([
                'message' => 'Art gallery not found'
            ], 404);
        }

        $artgallery->delete();

        return response()->json([
            'message' => 'Art gallery deleted successfully'
        ], 200);
    }
}