@extends('admin.admin_master')

@section('admin')


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Division</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('division.update' , $division->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="division_id" class="form-control" value="{{ $division->id }}">
                                <label for="">Coupon Name</label>
                                <input type="text" name="division_name" class="form-control" value="{{ $division->division_name }}">
                                @error('coupon_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                      

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>

                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>


@endsection()
