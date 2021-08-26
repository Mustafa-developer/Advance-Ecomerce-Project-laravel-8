@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">


    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Product</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('product-update', $products->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Brand Select <span class="text-danger">*</span></h5>
                                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" aria-invalid="false"
                                                        required="">
                                                        <option value="">Select Brand</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ ($brand->id == $products->brand_id ? "selected" : '') }}>
                                                            {{ $brand->brand_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Category Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" aria-invalid="false"
                                                        required="">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ ($category->id == $products->category_id ? "selected" : '') }}>
                                                            {{ $category->category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" class="form-control"
                                                        aria-invalid="false" required="">
                                                        <option value="">Select SubCategory</option>
                                                        @foreach($subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}"
                                                            {{ ($subcategory->id == $products->subcategory_id ? "selected" : '') }}>
                                                            {{ $subcategory->subcategory_name_en }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Sub SubCategory Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" class="form-control"
                                                        aria-invalid="false" required="">
                                                        <option value="">Select SubSubCategory</option>
                                                        @foreach($subsubcategories as $subsub)
                                                        <option value="{{ $subsub->id }}"
                                                            {{ ($subsub->id == $products->subsubcategory_id ? "selected" : '') }}>
                                                            {{ $subsub->sub_subcategory_name_en }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('subsubcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name En<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control"
                                                        required="" value="{{$products->product_name_en}}">
                                                    @error('product_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name Ur<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_ur" class="form-control"
                                                        required="" value="{{$products->product_name_ur}}">
                                                    <div class="help-block"></div>
                                                    @error('product_name_ur')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Code<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control"
                                                        required="" value="{{$products->product_code}}">
                                                    @error('product_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Quantity<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control"
                                                        required="" value="{{$products->product_qty}}">
                                                    @error('product_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tag En<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tag_en" class="form-control"
                                                        value="{{$products->product_tag_en}}" data-role="tagsinput"
                                                        required="">
                                                    @error('product_tag_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tag Ur<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tag_ur" class="form-control"
                                                        value="{{$products->product_tag_en}}" data-role="tagsinput"
                                                        required="">
                                                    @error('product_tag_ur')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size En<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" class="form-control"
                                                        value="{{$products->product_size_en}}" data-role="tagsinput"
                                                        >
                                                    @error('product_size_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size Ur<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_ur" class="form-control"
                                                        value="{{$products->product_size_ur}}" data-role="tagsinput"
                                                        >
                                                    @error('product_size_ur')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color En<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" class="form-control"
                                                        value="{{$products->product_color_en}}" data-role="tagsinput"
                                                        required="">
                                                    @error('product_color_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color Ur<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_ur" class="form-control"
                                                        value="{{$products->product_color_en}}" data-role="tagsinput"
                                                        required="">
                                                    @error('product_color_ur')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control"
                                                         value="{{$products->discount_price}}">
                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control"
                                                        required="" value="{{$products->selling_price}}">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Thumbnail<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thumbnail" onChange="mainThumUrl(this)" class="form-control" required="">
                                                    @error('product_thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThumb" alt="">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_desc_en" id="textarea" class="form-control"
                                                        required=""
                                                        placeholder="Short Description English">{{$products->short_desc_en}}</textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description Ur <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_desc_ur" id="textarea" class="form-control"
                                                        required=""
                                                        placeholder="Short Description Urdu">{{$products->short_desc_ur}}</textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_desc_en" rows="10" cols="80"
                                                        required="">
                                                   {{$products->long_desc_en}}
                                                </textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description Ur <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_desc_ur" rows="10" cols="80"
                                                        required="">
                                                    {{$products->long_desc_ur}}
                                                </textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals"
                                                            value="1" {{ $products->hot_deals == 1 ? 'checked' : '' }}>
                                                        <label for="checkbox_2">Hot Deals</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="featured" value="1"
                                                            {{ $products->featured == 1 ? 'checked' : '' }}>
                                                        <label for="checkbox_3">Featured</label>
                                                    </fieldset>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="special_offer"
                                                            value="1"
                                                            {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                                        <label for="checkbox_4">Speacial Offer</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals"
                                                            value="1"
                                                            {{ $products->special_deals == 1 ? 'checked' : '' }}>
                                                        <label for="checkbox_5">Special Deal</label>
                                                    </fieldset>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>


                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Update Product">
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                    </div>

                    <form method="post" action="{{ route('product-update-images') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row row-sm">
                            @foreach($multiImags as $img)
                            <div class="col-md-3">
                            <!-- <input type="text" value="{{$img->id}}"> -->
                                <div class="card">
                                    <img src="{{ asset($img->photo_name) }}" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('product.multiimg.delete', $img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i
                                                    class="fa fa-trash"></i> </a>
                                        </h5>
                                        <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span
                                                        class="tx-danger">*</span></label>
                                               
                                                <input class="form-control" type="file"
                                                    name="multi_img[ {{$img->id}} ]">
                                            </div>
                                        </p>

                                    </div>
                                </div>

                            </div><!--  end col md 3		 -->
                            @endforeach

                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thumbnail Image <strong>Update</strong></h4>
                    </div>

                    <form method="post" action="{{ route('product-update-thumbnail') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">
                        <div class="row row-sm">                         
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top">
                                    <div class="card-body">
                                      
                                        <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span
                                                        class="tx-danger">*</span></label>
                                              
                                                <input class="form-control" type="file" name="product_thumbnail" onChange="mainThumUrl(this)">
                                            </div>
                                        </p>
                                        <img src="" id="mainThumb" alt="">
                                    </div>
                                </div>
                            </div><!--  end col md 3		 -->                         
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>

                    </form>
                </div>
            </div>
        </div>
    </section>

</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="subcategory_id"]').on('change', function () {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/subsubcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .sub_subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });





    });

</script>

<script type="text/javascript">
    function mainThumUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mainThumb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0])
        }
    }

</script>



<script>
    $(document).ready(function () {
        $('#multiImg').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(80)
                                    .height(80); //create image element 
                                $('#preview_img').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });

</script>

@endsection
