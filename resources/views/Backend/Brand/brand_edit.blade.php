@extends('admin.admin_master')

@section('admin')


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-7">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('brand.update' , $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="brand_id" value="{{$brand->id}}">
                        <input type="hidden" class="form-control" name="old_image" value="{{$brand->brand_image}}">
                            <div class="form-group">
                                <label for="">Brand Name English</label>
                                <input type="text" name="brand_name_en" class="form-control" value="{{ $brand->brand_name_en }}">
                                @error('brand_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Brand Name Urdu</label>
                                <input type="text" name="brand_name_ur" class="form-control" value="{{ $brand->brand_name_ur }}">
                                @error('brand_name_ur')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Brand Image</label>
                                <input type="file" name="brand_image" class="form-control">
                                @error('brand_image')
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
