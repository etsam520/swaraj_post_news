<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\VisualStory;
use Illuminate\Http\Request;

class VisualStoryController extends Controller
{
    //
    public function visualStories()
    {
        $vs = VisualStory::with('translations')->isActive()->get();
        return response()->json($vs);
    }

    public function visualStoryView($id)
    {
        $visualStory = VisualStory::with(['slides'])->find($id)->toArray();

        return view('user.visual-stories', compact('visualStory'));
    }
}
