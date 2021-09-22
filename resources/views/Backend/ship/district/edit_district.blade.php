@extends('admin.admin_master')

@section('admin')


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-6">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit District</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('district.update' , $district->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="district_id" class="form-control" value="{{ $district->id }}">
                            <div class="form-group">
								<h5>Division Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="division_id" class="form-control" aria-invalid="false">
										<option value="" >Select Division</option>
                                        @foreach($divisions as $div)
										<option value="{{ $div->id }}" {{ $div->id == $district->division_id ? 'selected' : '' }}
                                            >{{ $div->division_name }}</option>
                                        @endforeach										
									</select>
                                    @error('division_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>
                            <div class="form-group">
                                <label for="">District Name</label>
                                <input type="text" name="district_name" class="form-control" value="{{ $district->district_name }}">
                                @error('district_name')
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
