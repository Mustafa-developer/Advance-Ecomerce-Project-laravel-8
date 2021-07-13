@extends('admin.admin_master')

@section('admin')

<div class="container-full">


    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Admin Change Password</h4>
            <!-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning"
                    href="">Admin Profile Edit </a></h6> -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{route('update.change.password')}}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Current Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" id="current_password" name="oldpassword" class="form-control" required=""
                                            data-validation-required-message="This field is required">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>New Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" id="password" name="password" class="form-control" required=""
                                            data-validation-required-message="This field is required">
                                        <div class="help-block"></div>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <h5>Confirm Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required=""
                                            data-validation-required-message="This field is required">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                            </div>
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


@endsection
