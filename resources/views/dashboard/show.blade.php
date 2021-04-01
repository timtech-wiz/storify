@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $story->title}}
                <a href="{{route('dashboard.index')}}" class="btn btn-default float-right">Go Back</a>
                </div>
                <div class="card-body">
                  <img src="{{$story->Thumbnails}}" width="700" alt="image">
                  <p class="card-text">{{$story->body}}</p>
                     Tags:
                  @foreach($story->tags as $tag)
                     
                      <button type="button" class="btn btn-sm btn-outline-primary">{{$tag->name}}</button>
                      @endforeach
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">{{$story->user->name}}</button>
                       
                    </div>
                    <small class="text-muted">{{$story->type}}</small>
                   
<!--
                   {{ $story->body}}
                        
                    <p class="font-weight-bold">
                        Status: {{$story->status == 1 ? 'Yes' : 'No'}}
                        Type: {{$story->type}} <br>
                        <small><i>{{$story->created_at}} By {{$story->user->name}}</i></small>
                    </p>
                        <p class="font-italic">{{$story->footnote}}</p>
                         
-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
