<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdmin;
use App\Mail\newStoryNotification;



class DashboardController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
         $query = Story::active();
             $type = request()->input('type');
        
        if(in_array($type, ['long', 'short'])){
            $query->where('type', $type);
        }
        
             $stories = $query->with('user', 'tags')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('dashboard.index', [
            'stories' => $stories
        ]);
    }
    
     public function show(Story $story)
    {
         //$story = Story::findOrfail($id);
        //$this->authorize('view', $story);
        return view('dashboard.show', [
            'story' => $story
        ]);
    }
    
    public function email(){
    
//    Mail::raw('This is a test email', function($message){
//        $message->to('admin@localhost.com')
//            ->subject('A New Story was added');
//        
//    });
        
        //Mail::send(new NotifyAdmin('title of the story'));
        mail::send( new newStoryNotification('title of the story'));
      dd('here');  
    }
}
