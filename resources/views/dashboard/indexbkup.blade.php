@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Stories') }} 
                <div class="float-right">
                    <a href="{{ route('dashboard.index')}}">All</a>
                    |
                    <a href="{{ route('dashboard.index', ['type' => 'long'])}}">Long</a>
                    |
                    <a href="{{ route('dashboard.index', ['type' => 'short'])}}">Short</a>
                </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                               <th>Image</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Author</th>
                            </tr>
                        </thead>
                            <tbody>
                            @if(count($stories) > 0)
                                @foreach($stories as $story)
                                <tr>
                                   <td><img src="{{$story->Thumbnails}}" alt="image"></td>
                                    <td>{{$story->title}}</td>
                                    <td>{{$story->type}}</td>
                                    <td>{{$story->user->name}}</td>
                                    <td>
                                    <a href="{{ route('dashboard.show', [$story])}}" class="btn btn-secondary"> 
                                        View
                                    </a></td>
                                </tr>
                   
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$stories->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 