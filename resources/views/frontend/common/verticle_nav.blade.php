<div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                    <nav class="yamm megamenu-horizontal">
                        <ul class="nav">
                            @foreach($categories as $category)
                            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                                    data-toggle="dropdown"><i class="icon {{$category->category_icon}}"
                                        aria-hidden="true"></i>@if(session()->get('language') == 'urdu')
                                    {{ $category->category_name_ur}} @else {{ $category->category_name_en}} @endif</a>
                                <ul class="dropdown-menu mega-menu">
                                    <li class="yamm-content">
                                        @php
                                        $subcategories = App\Models\SubCategory::where('category_id' ,
                                        $category->id)->orderBy('subcategory_name_en' , 'ASC')->get();
                                        @endphp

                                        <div class="row">
                                            @foreach($subcategories as $subcategory)
                                            <div class="col-xs-12 col-sm-6 col-md-4 ">
                                                <a href="{{url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en)}}">
                                                <h2 class="title">
                                                    @if(session()->get('language') == 'urdu')
                                                    {{ $subcategory->subcategory_name_ur }} @else
                                                    {{ $subcategory->subcategory_name_en }} @endif
                                                </h2>
                                                </a>

                                                @php
                                                $subsubcategories = App\Models\SubSubCategory::where('subcategory_id' ,
                                                $subcategory->id)->orderBy('sub_subcategory_name_en' , 'ASC')->get();
                                                @endphp

                                                <ul class="links list-unstyled">
                                                    @foreach($subsubcategories as $subcat)
                                                    <li><a href="{{url('subsubcategory/product/'.$subcat->id.'/'.$subcat->sub_subcategory_slug_en)}}">@if(session()->get('language') == 'urdu')
                                                            {{ $subcat->sub_subcategory_name_ur }} @else
                                                            {{ $subcat->sub_subcategory_name_en }} @endif </a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endforeach
                                            <!-- /.col -->

                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- /.yamm-content -->
                                </ul>
                                <!-- /.dropdown-menu -->
                            </li>
                            @endforeach
                            <!-- /.menu-item -->


                            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                                    data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
                                <!-- /.dropdown-menu -->
                            </li>
                            <!-- /.menu-item -->

                            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                                    data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a>
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                <!-- /.dropdown-menu -->
                                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                            </li>
                            <!-- /.menu-item -->

                            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                                    data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a>
                                <!-- /.dropdown-menu -->
                            </li>
                            <!-- /.menu-item -->

                        </ul>
                        <!-- /.nav -->
                    </nav>
                    <!-- /.megamenu-horizontal -->
                </div>