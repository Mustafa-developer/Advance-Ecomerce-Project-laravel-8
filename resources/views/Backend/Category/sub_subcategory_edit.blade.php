@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Sub SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('subsubcategory.update' , $cats->id) }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="subsub_id" value="{{ $cats->id }}">
                            <div class="form-group">
								<h5>Category Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control" aria-invalid="false">
										<option value="" >Select Category</option>
                                        @foreach($categories as $category)
										<option value="{{ $category->id }}" {{ $category->id == $cats->category_id ? 'selected' : ''}} >{{ $category->category_name_en }}</option>
                                        @endforeach										
									</select>
                                    @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>


                            <div class="form-group">
								<h5>Sub Category Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="subcategory_id" class="form-control" aria-invalid="false">
										<option value="" >Select SubCategory</option>
                                       		@foreach($subcategories as $subsub)
										<option value="{{ $subsub->id }}" {{ $subsub->id == $cats->subcategory_id ? 'selected' : ''}} >{{ $subsub->subcategory_name_en }}</option>
                                        @endforeach								
									</select>
                                    @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>
                            
                            <div class="form-group">
                                <label for="">Sub SubCategory  English</label>
                                <input type="text" name="sub_subcategory_name_en" class="form-control" value="{{ $cats->sub_subcategory_name_en }}">
                                @error('sub_subcategory_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Sub Category Name Urdu</label>
                                <input type="text" name="sub_subcategory_name_ur" class="form-control" value="{{ $cats->sub_subcategory_name_ur }}">
                                @error('sub_subcategory_name_ur')
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

<script type="text/javascript">
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
    </script>

@endsection()
