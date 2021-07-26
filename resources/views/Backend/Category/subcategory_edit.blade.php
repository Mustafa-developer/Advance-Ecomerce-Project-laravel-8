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
                        <form action="{{ route('subcategory.update' , $cats->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="subcategory_id" class="form-control" value="{{ $cats->id }}">
                            <div class="form-group">
								<h5>Sub Category Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control" aria-invalid="false">
										<option value="" >Select Category</option>
                                        @foreach($categories as $category)
										<option value="{{ $category->id }}" {{ $category->id == $cats->category_id ? 'selected' : '' }}
                                            >{{ $category->category_name_en }}</option>
                                        @endforeach										
									</select>
                                    @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>
                            <div class="form-group">
                                <label for="">Sub Category Name English</label>
                                <input type="text" name="subcategory_name_en" class="form-control" value="{{ $cats->subcategory_name_en }}">
                                @error('category_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Sub Category Name Urdu</label>
                                <input type="text" name="subcategory_name_ur" class="form-control" value="{{ $cats->subcategory_name_ur }}">
                                @error('category_name_ur')
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
