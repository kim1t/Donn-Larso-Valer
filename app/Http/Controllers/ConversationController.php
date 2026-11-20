
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::all();

        return response()->json([
            'message' => 'Conversations retrieved successfully',
            'data' => $conversations
        ], 200);
    }

    public function show($id)
    {
        $conversation = Conversation::with(['participants', 'messages'])
            ->find($id);

        if (!$conversation) {
            return response()->json([
                'message' => 'Conversation not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Conversation retrieved successfully',
            'data' => $conversation
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $conversation = Conversation::create($validated);

        return response()->json([
            'message' => 'Conversation created successfully',
            'data' => $conversation
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json([
                'message' => 'Conversation not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255'
        ]);

        $conversation->update($validated);

        return response()->json([
            'message' => 'Conversation updated successfully',
            'data' => $conversation
        ], 200);
    }

    public function destroy($id)
    {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json([
                'message' => 'Conversation not found'
            ], 404);
        }

        $conversation->delete();

        return response()->json([
            'message' => 'Conversation deleted successfully'
        ], 200);
    }
}
