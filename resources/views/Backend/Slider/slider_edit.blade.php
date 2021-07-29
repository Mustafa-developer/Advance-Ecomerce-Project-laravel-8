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
                        <h3 class="box-title">Edit Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('slider.update' , $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="slider_id" value="{{$slider->id}}">
                        <input type="hidden" class="form-control" name="old_image" value="{{$slider->slider_img}}">
                            <div class="form-group">
                                <label for="">Slider Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Slider Description</label>
                                <input type="text" name="description" class="form-control" value="{{ $slider->description }}">
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Brand Image</label>
                                <input type="file" name="slider_img" class="form-control">
                                @error('slider_img')
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
