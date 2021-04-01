@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                Edit Profile
                </div>
                <div class="card-body">
                 <form action="{{route('profiles.update', [$user])}}" method="POST">
                  @csrf
                  @method('PUT')
                  
                     <div class="form-group">
                       <label for="name">Name</label>
                       <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name)}}">
                       @error('name')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                       
                       @enderror
                   </div>
                   
                     <div class="form-group">
                       <label for="email">Email</label>
                       <input type="text" readonly="readonly" name="email" class="form-control" value="{{ $user->email }}">
                       
                   </div>
                   
                   <div class="form-group">
                       <label for="bio">Biography</label>
                      <textarea name="bio" class="form-control @error('bio') is-invalid @enderror">
                           {{ old('bio', $user->profile->bio ?? '')}}
                      </textarea>
                      
                       @error('bio')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                       
                       @enderror
                   </div>
                   
                    <div class="form-group">
                       <label for="address">Address</label>
                       <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $user->profile->address ?? '')}}">
                       @error('address')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                       
                       @enderror
                   </div>
                  
                  
                  
                 <button class="btn btn-primary">Update</button>
                </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
