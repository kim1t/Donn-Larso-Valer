
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        return response()->json([
            'message' => 'Messages retrieved successfully',
            'data' => $messages
        ], 200);
    }

    public function show($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'message' => 'Message not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Message retrieved successfully',
            'data' => $message
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string',
            'offer_id' => 'nullable|exists:exhibition_artwork,id',
        ]);

        $message = Message::create($validated);

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'message' => 'Message not found'
            ], 404);
        }

        $validated = $request->validate([
            'message' => 'sometimes|required|string',
            'offer_id' => 'sometimes|nullable|exists:exhibition_artwork,id',
        ]);

        $message->update($validated);

        return response()->json([
            'message' => 'Message updated successfully',
            'data' => $message
        ], 200);
    }

    public function destroy($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'message' => 'Message not found'
            ], 404);
        }

        $message->delete();

        return response()->json([
            'message' => 'Message deleted successfully'
        ], 200);
    }
}
