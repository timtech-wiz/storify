@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-header"> 
                Add Story
                </div>
                <div class="card-body">
                 <form action="{{route('stories.store')}}" method="POST" enctype="multipart/form-data">
                 
                  @csrf
                   @include('story.form')
                   
                   
                    <button class="btn btn-primary">Add</button>
                </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
