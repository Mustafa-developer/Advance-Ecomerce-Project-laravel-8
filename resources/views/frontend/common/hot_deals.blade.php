@php
$hot_deals = App\Models\Product::where('hot_deals' , 1)->where('status' , 1)->where('discount_price' ,'!=' ,
Null)->orderBy('id','DESC')->limit(6)->get();

@endphp

<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">hot deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach($hot_deals as $item)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{ asset($item->product_thumbnail) }}" alt=""> </div>
                    @php
                    $amount = $item->selling_price - $item->discount_price;
                    $discount = ($amount/$item->selling_price)*100;
                    @endphp

                    @if($item->discount_price == null)
                    <div class="sale-offer-tag"><span>New<br></span></div>
                    @else
                    <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>
                            off</span></div>

                    @endif

                    <div class="timing-wrapper">
                        <div class="box-wrapper">
                            <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                        </div>
                        <div class="box-wrapper hidden-md">
                            <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                        </div>
                    </div>
                </div>
                <!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a
                            href="{{ url('product/detail/'.$item->id.'/'.$item->product_slug_en) }}">@if(session()->get('language')
                            == 'urdu')
                            {{ $item->product_name_ur }} @else
                            {{  $item->product_name_en }} @endif</a></h3>
                    <div class="rating rateit-small"></div>
                    @if($item->discount_price == NULL)
                    <div class="product-price"> <span class="price"> $600.00 </span> </div>
                    @else
                    <div class="product-price"> <span class="price"> ${{ $item->discount_price }}
                        </span> <span class="price-before-discount">${{ $item->selling_price }}</span>
                    </div>
                    @endif
                    <!-- /.product-price -->

                </div>
                <!-- /.product-info -->

                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <div class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </div>
                    </div>
                    <!-- /.action -->
                </div>
                <!-- /.cart -->
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.sidebar-widget -->
</div>
