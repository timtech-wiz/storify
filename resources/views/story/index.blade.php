@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Stories') }} 
                @can('create', App\Models\Story::class)
                <a href="{{route('stories.create')}}" class="float-right btn btn-warning">
                    Add Story
                </a>
                @endcan
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                               <th>Image</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Tags</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            
                            
                        </thead>
                        <tbody>
                            @if(count($stories) > 0)
                                @foreach($stories as $story)
                                <tr>
                                   <td><img src="{{$story->Thumbnails}}" width="50" alt="image"></td>
                                    <td>{{$story->title}}</td>
                                    <td>{{$story->type}}</td>
                                    <td>{{$story->status == 1 ? 'Yes' : 'No'}}</td>
                                     
                                    <td>
                                         @foreach($story->tags as $tag)
                                         {{$tag->name}}
                                          @endforeach
                                      </td>
                                      <td> 
                                       @can('view', $story)
                                        <a href="{{route('stories.show', [$story])}}" class="btn btn-secondary">View</a>
                                        @endcan
                                        
                                        @can('update', $story)
                                        <a href="{{route('stories.edit', [$story])}}" class="btn btn-secondary">Edit</a>
                                        @endcan
                                        @can('delete', $story)
                                        <form action="{{ route('stories.destroy', [$story])}}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                            
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                
                                
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$stories->links()}}
                </div>
            </div>
        </div>
    </div>
    <x-alert message = 'first'/>
    <hr>
    <x-alert message = 'second'/>
    <hr>
</div>
@endsection
