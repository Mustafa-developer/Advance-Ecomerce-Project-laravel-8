@extends('admin.admin_master')

@section('admin')

<div class="container-full">


    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Admin Profile Edit</h4>
            <!-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning"
                    href="">Admin Profile Edit </a></h6> -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form  action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Name Field <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" required=""
                                                    data-validation-required-message="This field is required"
                                                    value="{{$editData->name}}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Email Field <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" required=""
                                                    data-validation-required-message="This field is required"
                                                    value="{{$editData->email}}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Profile Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input id="image" type="file" name="profile_photo_path" class="form-control" >
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <img id="show_image" class="rounded-circle" 
                                        src="{{ (!empty($editData->profile_photo_path))? 
                      url('uploads/admin_images/'.$editData->profile_photo_path):url('uploads/no_image.jpg') }}"
                                            alt="User Avatar" style="max-width:100px">
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                            </div>
                    </form>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>

</div>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  
<script>

$(document).ready(function(){
    $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#show_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});

</script>
@endsection
