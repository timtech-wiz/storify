<?php

namespace App\Http\Controllers;
use App\Events\StoryCreated;
use App\Events\StoryEdited;
use App\Http\Requests\StoryRequest;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\newStoryNotification;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use App\Models\tag;


class StoriesController extends Controller
{
    
    public function __construct(){
        $this->authorizeResource(Story::class, 'story');
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $stories = Story::where('user_id', auth()->user()->id)
             ->with('tags')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('story.index', [
            'stories' => $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create');
        
        $story = new Story;
        $tags = tag::get();
        return view('story.create',[
            'story' => $story,
            'tags'  => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
         $story = auth()->user()->stories()->create($request->all());
        //Mail::send( new newStoryNotification($story->title));
        //Log::info('A story with title '. $story->title .' has been added');
        
        //event( new StoryCreated($story->title));
        $story->tags()->sync($request->tags);
         if($request->hasFile('image')){
          $this->_uploadImage($request, $story);
        }
        
         return redirect()->route('stories.index')->with('status', 'Story created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
         //$story = Story::findOrfail($id);
        //$this->authorize('view', $story);
        return view('story.show', [
            'story' => $story
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //Gate::authorize('edit-story', $story);
        //$this->authorize('update', $story);
        
        $tags = tag::get();
        return view('story.edit', [
            'story' => $story,
            'tags' => $tags 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, Story $story)
    {
     
        $story->update($request->all());
        
        //event( new StoryEdited($story->title));
        
          if($request->hasFile('image')){
          $this->_uploadImage($request, $story);
        }
        $story->tags()->sync($request->tags);
         return redirect()->route('stories.index')->with('status', 'Story Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //$this->authorize('delete', $story);
        $story->delete();
         return redirect()->route('stories.index')->with('status', 'Story Deleted successfully');
    }
    
    public function _uploadImage($request, $story){
          if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time(). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(255, 100)->save(public_path('storage/'. $filename));
            $story->image = $filename;
            $story->save();
        }
    }
    
 
}
