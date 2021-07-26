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
                        <h3 class="box-title">SubCategory List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body p-0">
                        <div class="table-responsive p-0">
                            <table id="example1" class="table table-bordered table-striped p-0">
                                <thead>
                                    <tr class="p-0">
                                        <th>Catgeory</th>
                                        <th>SubCategoryEn</th>
                                        <th>SubCategoryUr</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cats as $cat)
                                    <tr>
                                        
                                        <td>{{ $cat['Category']['category_name_en'] }}</td>
                                        <td>{{ $cat->subcategory_name_en }}</td>
                                        <td>{{ $cat->subcategory_name_ur }}</td>

                                        <td>
                                            <a href="{{ route('subcategory.edit' , $cat->id) }}" class="btn btn-info"
                                                title="Edit-Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('subcategory.delete' , $cat->id) }}" id="delete"
                                                class="btn btn-danger" title="Delete-Data"><i
                                                    class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Add Sub Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('store.subcategory') }}" method="POST">
                            @csrf
                            <div class="form-group">
								<h5>Category Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control" aria-invalid="false">
										<option value="" >Select Category</option>
                                        @foreach($categories as $category)
										<option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                        @endforeach										
									</select>
                                    @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>
                            
                            <div class="form-group">
                                <label for="">Sub Category Name English</label>
                                <input type="text" name="subcategory_name_en" class="form-control">
                                @error('subcategory_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Sub Category Name Urdu</label>
                                <input type="text" name="subcategory_name_ur" class="form-control">
                                @error('subcategory_name_ur')
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
