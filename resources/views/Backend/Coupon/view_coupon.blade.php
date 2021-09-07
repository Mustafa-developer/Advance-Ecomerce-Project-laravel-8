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
                        <h3 class="box-title">Coupon List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Coupon Name</th>
                                        <th>Coupon Discount</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $item)
                                    <tr>
                                        
                                        <td>{{ $item->coupon_name }}</td>
                                        <td>{{ $item->coupon_discount }}%</td>
                                        <td style="width:30%">
                                        {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}    
                                       </td>
                                        <td>

                                            @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge-phill badge-success">Valid</span>
                                            @else
                                            <span class="badge badge-phill badge-danger">Invalid</span>
                                            @endif

                                        </td>

                                        <td style="width:30%">
                                            <a href="{{ route('category.edit' , $item->id) }}" class="btn btn-info"
                                                title="Edit-Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('category.delete' , $item->id) }}" id="delete"
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
                        <h3 class="box-title">Add Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('store.coupon') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Coupon Name</label>
                                <input type="text" name="coupon_name" class="form-control">
                                @error('coupon_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Coupon Discount(%)</label>
                                <input type="text" name="coupon_discount" class="form-control">
                                @error('coupon_discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Coupon Validity</label>
                                <input type="date" name="coupon_validity" class="form-control" 
                                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
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
