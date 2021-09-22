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
                        <h3 class="box-title">Update Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('coupon.update' , $coupon->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="coupon_id" class="form-control" value="{{ $coupon->id }}">
                                <label for="">Coupon Name</label>
                                <input type="text" name="coupon_name" class="form-control" value="{{ $coupon->coupon_name }}">
                                @error('coupon_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Coupon Discount</label>
                                <input type="text" name="coupon_discount" class="form-control" value="{{ $coupon->coupon_discount }}">
                                @error('coupon_discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Counpon Validity</label>
                                <input type="date" name="coupon_validity" class="form-control"
                                min="{{ Carbon\Carbon::now()->format('Y-m-d')  }}" value="{{ $coupon->coupon_validity }}">
                                @error('coupon_validity')
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
