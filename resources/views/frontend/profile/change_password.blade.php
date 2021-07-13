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
                <h3 class="text-center"><span class="text-danger">Change Password</h3>
            </div>

            <div class="card-body">
                <form action="{{route('user.profile.update')}}" method="post" >
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Current Password</label>
                        <input type="password" id="current_password" type="password" class="form-control" name="oldpassword" >
                    </div>
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
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
