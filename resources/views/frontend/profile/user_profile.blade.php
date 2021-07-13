@extends('frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <br>
                <img class="card-img-top img-fluid" style="border-radius:50%" alt="" src="{{ (!empty($users->profile_photo_path))? 
                      url('uploads/user_images/'.$users->profile_photo_path):url('uploads/no_image.jpg') }}" height="100%" width="100%">
                      <br><br>
                      <ul class="list-group list-group-flush" >
                          <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                          <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                          <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                          <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                      </ul>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">

            <div class="card">
                <h3 class="text-center"><span class="text-danger">Hi..... <strong>{{
                    Auth::user()->name}}</strong></span> Update Profile</h3>
            </div>

            <div class="card-body">
                <form action="{{route('user.profile.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$users->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$users->email}}">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$users->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="">User Image</label>
                        <input type="file" class="form-control" name="profile_photo_path" value="{{$users->profile_photo_path}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>
</div>

@endsection
