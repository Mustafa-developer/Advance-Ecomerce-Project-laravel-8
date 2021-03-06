@extends('admin.admin_master')

@section('admin')


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Brand List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Brand English</th>
                                        <th>Brand Urdu</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->brand_name_en }}</td>
                                        <td>{{ $brand->brand_name_ur }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" style="width:70px" height="40px"
                                                alt=""></td>
                                        <td>
                                            <a href="{{ route('brand.edit' , $brand->id) }}" class="btn btn-info" title="Edit-Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('brand.delete' , $brand->id) }}" id="delete" class="btn btn-danger" title="Delete-Data"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="">Brand Name English</label>
                                <input type="text" name="brand_name_en" class="form-control">
                                @error('brand_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Brand Name Urdu</label>
                                <input type="text" name="brand_name_ur" class="form-control">
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
