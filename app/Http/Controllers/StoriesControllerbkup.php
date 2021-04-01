<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoriesController extends Controller
{
    public function index(){
        
        $stories = Story::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('story.index', [
            'stories' => $stories
        ]);
    }
    
    public function show(Story $story){
        //$story = Story::findOrfail($id);
        
        return view('story.show', [
            'story' => $story
        ]);
    }
}
