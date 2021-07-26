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
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('category.update' , $category->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="category_id" class="form-control" value="{{ $category->id }}">
                                <label for="">Category Name English</label>
                                <input type="text" name="category_name_en" class="form-control" value="{{ $category->category_name_en }}">
                                @error('category_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Category Name Urdu</label>
                                <input type="text" name="category_name_ur" class="form-control" value="{{ $category->category_name_ur }}">
                                @error('category_name_ur')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Category Icon</label>
                                <input type="text" name="category_icon" class="form-control" value="{{ $category->category_icon }}">
                                @error('category_icon')
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
