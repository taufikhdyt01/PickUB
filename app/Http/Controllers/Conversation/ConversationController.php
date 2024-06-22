<?php

namespace App\Http\Controllers\Conversation;

use App\Events\WebSocketEvent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $conversations = null;
        if (isset($user->id)) {
            $conversations = Conversation::where('user1_id', $user->id)
                ->orWhere('user2_id', $user->id)
                ->with(['messages', 'user1', 'user2'])
                ->get();
        }

        return view('index', compact('user', 'conversations'));
    }

    public function newConversations(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $existingConversations = null;
        $usersWithoutConversations = null;
        if (isset($user->id)) {
            $existingConversations = Conversation::where('user1_id', $user->id)
                ->orWhere('user2_id', $user->id)
                ->get()
                ->pluck('user1_id', 'user2_id')
                ->toArray();
        }
        if (isset($user->id)) {
            $usersWithoutConversations = User::whereNotIn('id', array_merge(array_keys($existingConversations), (array)array_values($existingConversations)))
                ->where('id', '!=', $user->id)
                ->get();
        }

        return view('new', compact('user', 'usersWithoutConversations'));
    }

    public function createConversation(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $userId = $user->id ?? null;
        $otherUserId = $request->input('user_id');

        Conversation::create([
            'user1_id' => $userId,
            'user2_id' => $otherUserId
        ]);

        return redirect('/');
    }

    public function sendMessage(Request $request, $conversationId): JsonResponse
    {
        $user = Auth::user();
        $userId = $user->id ?? null;
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-IMAGE.'. $file->getClientOriginalExtension();
            $file->move(public_path('media'), $filename);
            $imageUrl = 'media/' . $filename;
        }

        $message = Message::create([
            'conversation_id' => $conversationId,
            'user_id' => $userId,
            'message' => $request->input('message'),
            'image_url' => $imageUrl,
        ]);

        event(new WebSocketEvent([
            'event' => 'message',
            'data' => $message
        ]));
        return response()->json($message, 201);
    }

    public function sendStatusTyping(Request $request, $conversationId): JsonResponse
    {
        $user = Auth::user();
        $userId = $user->id ?? null;
        $userName = $user->name ?? null;

        event(new WebSocketEvent([
            'event' => 'typing',
            'data' => [
                'conversationId' => $conversationId,
                'userId' => $userId,
                'userName' => $userName,
                'isTyping' => $request->input('isTyping'),
            ]
        ]));
        return response()->json(['status' => 'typing'], 201);
    }
}
