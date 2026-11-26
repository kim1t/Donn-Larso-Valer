<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Participant;
use App\Models\User;
use App\Models\Artist;
use App\Models\ArtGallery;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::all();

        return response()->json([
            'message' => 'Participants retrieved successfully',
            'data' => $participants
        ], 200);
    }

    public function show($id)
    {
        $participant = Participant::with('participantable')
            ->find($id);

        if (!$participant) {
            return response()->json([
                'message' => 'Participant not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Participant retrieved successfully',
            'data' => $participant
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'participantable_type' => [
                'required',
                Rule::in([
                    User::class,
                    Artist::class,
                    ArtGallery::class
                ])
            ],
            'participantable_id' => 'required|integer|min:1',
        ]);

        $model = $validated['participantable_type'];

        if (!$model::where('id', $validated['participantable_id'])->exists()) {
            return response()->json([
                'message' => 'The selected participant does not exist'
            ], 422);
        }

        $participant = Participant::create($validated);

        return response()->json([
            'message' => 'Participant added successfully',
            'data' => $participant
        ], 201);
    }

    public function destroy($id)
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json([
                'message' => 'Participant not found'
            ], 404);
        }

        $participant->delete();

        return response()->json([
            'message' => 'Participant removed successfully'
        ], 200);
    }
}
