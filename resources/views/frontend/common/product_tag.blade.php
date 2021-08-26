
@php
$tag_en = App\Models\Product::groupBy('product_tag_en')->select('product_tag_en')->get();
$tag_ur = App\Models\Product::groupBy('product_tag_ur')->select('product_tag_ur')->get();
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list"> 

        @if(session()->get('language') == 'urdu')   
        
            @foreach($tag_ur as $item)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$item->product_tag_ur) }}">  {{str_replace(',' , ' ', $item->product_tag_ur)  }} </a>
            @endforeach

            @else

            @foreach($tag_en as $item)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$item->product_tag_en) }}">  {{  str_replace(',' , ' ', $item->product_tag_en) }} </a>
            @endforeach

            @endif
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
