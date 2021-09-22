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
                        <h3 class="box-title">Edit State</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('state.update' , $state->id) }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="state_id" value="{{ $state->id }}">
                            <div class="form-group">
								<h5>Division Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="division_id" class="form-control" aria-invalid="false">
										<option value="" >Select Division</option>
                                        @foreach($divisions as $div)
										<option value="{{ $div->id }}" {{ $div->id == $state->division_id ? 'selected' : ''}} >{{ $div->division_name }}</option>
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
                                       		@foreach($district as $dis)
										<option value="{{ $dis->id }}" {{ $dis->id == $state->district_id ? 'selected' : ''}} >{{ $dis->district_name }}</option>
                                        @endforeach								
									</select>
                                    @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

								<div class="help-block"></div></div>
							</div>
                            
                            <div class="form-group">
                                <label for="">State</label>
                                <input type="text" name="state" class="form-control" value="{{ $state->state }}">
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
