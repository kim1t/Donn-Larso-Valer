<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
class MediaController extends Controller
{
    public function index(){
        $media = Media::all();

        return response()->json([
            'message'=>'All media retrieved successfully',
            'data'=> $media
        ]);
    }

   public function show($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'message' => 'Media not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Media retrieved successfully',
            'data' => $media
        ], 200);
    }


    public function store(Request $request){
        $validated = $request->validate([
            'media_name' => 'required|string|max:255',
            'media_type' => 'required|string|max:255'
        ]);

        $media = Media::create($validated);
        return response()->json([
            'message' => 'Media created successfully',
            'data' => $media
        ],201);
    }

    public function update(Request $request, $id){
        $media = Media::find($id);

        if(!$media){
            return response()->json([
                'message' => 'Media not found'
            ], 404);
        }

        $validated = $request->validate([
            'media_name' => 'required|string|max:255',
            'media_type' => 'required|string|max:255'
        ]);

        $media->update($validated);

        return response()->json([
            'message' => 'Media updated successfully',
            'data'=> $media
        ], 200);
    }

    public function destroy($id){
        $media = Media::find($id);

        if(!$media){
            return response()->json([
                'message' => 'Media not found'
            ], 404);
        }

        $media->delete();

        return response()->json([
            'message' => 'Media deleted successfully'
        ], 200);
    }
}
