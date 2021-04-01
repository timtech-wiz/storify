<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;

class StoriesController extends Controller
{
    public function index(){
        $stories = Story::onlyTrashed()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        
        return view('admin.story.index', [
            'stories' => $stories
        ]);
    }
    
    public function restore($id){
        $story = Story::withTrashed()->findOrFail($id);
        $story->restore();
        return redirect()->route('admin.stories.index')->with('status', 'Story restored successfully');
    }
    
     public function delete($id){
         $story = Story::withTrashed()->findOrFail($id);
        $story->forceDelete();
        return redirect()->route('admin.stories.index')->with('status', 'Story deleted successfully');
    }
    
       public function stats(){
        $stories = Story::active()->with('user')->whereCreatedThisMonth()->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.story.stats',[
            'stories' => $stories
        ]);
    }
}
