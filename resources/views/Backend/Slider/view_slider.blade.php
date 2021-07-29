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
                                        <th>Slider Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $item)
                                    <tr>
                                        <td> <img src="{{ asset($item->slider_img) }}" alt=""
                                                style="width:60px ; height:50px"> </td>

                                        <td>
                                            @if($item->title == NULL)
                                            <span class="badge badge-pill badge-danger">No Title</span>
                                            @else
                                            {{ $item->title }}
                                            @endif
                                        </td>

                                        <td>{{ $item->description }}</td>

                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success"> Active </span>
                                            @else
                                            <span class="badge badge-pill badge-danger"> InActive </span>
                                            @endif

                                        </td>

                                        <td width="30%">
                                            <a href="{{ route('slider.edit',$item->id) }}" class="btn btn-info btn-sm"
                                                title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                            <a href="{{ route('slider.delete',$item->id) }}"
                                                class="btn btn-danger btn-sm" title="Delete Data" id="delete">
                                                <i class="fa fa-trash"></i></a>

                                            @if($item->status == 1)
                                            <a href="{{ route('slider.inactive',$item->id) }}"
                                                class="btn btn-danger btn-sm" title="Inactive Now"><i
                                                    class="fa fa-arrow-down"></i> </a>
                                            @else
                                            <a href="{{ route('slider.active',$item->id) }}"
                                                class="btn btn-success btn-sm" title="Active Now"><i
                                                    class="fa fa-arrow-up"></i> </a>
                                            @endif

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
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Slider Title</label>
                                <input type="text" name="title" class="form-control">
                                
                            </div>

                            <div class="form-group">
                                <label for="">Slider Description</label>
                                <input type="text" name="description" class="form-control">
                               
                            </div>

                            <div class="form-group">
                                <label for="">Slider Image</label>
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
