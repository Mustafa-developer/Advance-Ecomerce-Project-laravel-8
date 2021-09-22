@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">State List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                        <th>State Name</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($state as $item)
                                    <tr>
                                        
                                        <td>{{ $item['division']['division_name'] }}</td>
                                        <td>{{ $item['district']['district_name'] }}</td>
                                        <td>{{ $item->state }}</td>
                                        
                                 

                                        <td style="width:30%">
                                            <a href="{{ route('state.edit' , $item->id) }}" class="btn btn-info"
                                                title="Edit-Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('state.delete' , $item->id) }}" id="delete"
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
                        <h3 class="box-title">Add State</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('store.state') }}" method="POST">
                            @csrf

                            <div class="form-group">
								<h5>Division Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="division_id" class="form-control" aria-invalid="false">
										<option value="" >Select Division</option>
                                        @foreach($divisions as $division)
										<option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                        @endforeach										
									</select>
                                    @error('division_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>

                            <div class="form-group">
								<h5>District Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="district_id" class="form-control" aria-invalid="false">
										<option value="" >Select District</option>
                                        									
									</select>
                                    @error('district-id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>

                            <div class="form-group">
                                <label for="">State Name</label>
                                <input type="text" name="state" class="form-control">
                                @error('state')
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
        $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{  url('/shipping/district/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="district_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
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
