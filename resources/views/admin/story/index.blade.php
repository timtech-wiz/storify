@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Deleted Stories') }} 
               
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>User</th>
                                <th>Action</th>
                                
                            </tr>
                            
                            
                        </thead>
                        <tbody>
                            @if(count($stories) > 0)
                                @foreach($stories as $story)
                                <tr>
                                    <td>{{$story->title}}</td>
                                    <td>{{$story->type}}</td>
                                    <td>{{$story->user->name}}</td>
                                  <td>
                                    <form action="{{ route('admin.stories.restore', [$story])}}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-success btn-sm">Restore</button>

                                    </form>
                                    
                                      <form action="{{ route('admin.stories.delete', [$story])}}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">Delete</button>

                                    </form>
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
</div>
@endsection
 
