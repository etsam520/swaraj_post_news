<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        try {
            $request->validate([
                'news_id' => 'required|exists:news,id',
                'comment' => 'required|string|max:500',
            ]);

            $comment = Comment::create([
                'user_id' => auth('web')->id(),
                'news_id' => $request->news_id,
                'content' => $request->comment,
            ]);

            return response()->json(['success' => true, 'message' => 'Comment added successfully!', 'comment' => $comment], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to add comment!', 'error' => $e->getMessage()], 500);
        }
    }

    public function getComments(Request $request, $newsID)
    {
        $comments = Comment::with([
            'replies.replies.user', // Load replies' replies and their users
            'replies.user',         // Load replies and their users
            'user'                  // Load main comment user
        ])
        ->where('news_id', $newsID)
        ->whereNull('parent_id') // Fetch only top-level comments
        ->get();

        return response()->json($comments);
    }


    public function replyStore(Request $request)
    {
        try {
            $request->validate([
                'news_id' => 'required|exists:news,id',
                'content' => 'required|string|max:500',
                'parent_id' => 'nullable|exists:comments,id',
            ]);

            $comment = Comment::create([
                'user_id' => auth('web')->id(),
                'news_id' => $request->news_id,
                'content' => $request->content,
                'parent_id' => $request->parent_id, // Handle replies
            ]);

            return response()->json(['success' => true, 'message' => 'Reply added successfully!', 'comment' => $comment], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to add reply!', 'error' => $e->getMessage()], 500);
        }
    }
}
