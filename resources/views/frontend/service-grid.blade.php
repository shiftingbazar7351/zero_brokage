@extends('frontend.layouts.main')
@section('content')
    <div class="bg-img">
        <img src="{{ asset('assets/img/bg/work-bg-03.png') }}" alt="img" class="bgimg1">
        <img src="{{ asset('assets/img/bg/work-bg-03.png') }}" alt="img" class="bgimg2">
        <img src="{{ asset('assets/img/bg/feature-bg-03.png') }}" alt="img" class="bgimg3">
    </div>

    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Service Grid</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Service Grid</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3 col-sm-12 theiaStickySidebar">
                    <div class="filter-div">
                        <div class="filter-head">
                            <h5>Filter by</h5>
                            <a href="#" class="reset-link">Reset Filters</a>
                        </div>
                        <div class="filter-content">
                            <h2>Keyword</h2>
                            <input type="text" class="form-control" placeholder="What are you looking for?">
                        </div>
                        <div class="filter-content">
                            <h2>Location</h2>
                            <div class="group-img">
                                <input type="text" class="form-control" placeholder="Select Location">
                                <i class="feather-map-pin"></i>
                            </div>
                        </div>
                        <div class="filter-content">
                            <h2>Categories <span><i class="feather-chevron-down"></i></span></h2>
                            <div class="filter-checkbox" id="fill-more">
                                <ul>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">All Categories</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Construction</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Car Wash</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Electrical</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Cleaning</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Interior</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Computer</b>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a>
                        </div>
                        <div class="filter-content">
                            <h2>Sub Category</h2>
                            <select class="form-control select">
                                <option>All Sub Category</option>
                                <option>Computer</option>
                                <option>Construction</option>
                            </select>
                        </div>
                        <!-- <div class="filter-content">
                                <h2>Location</h2>
                                <div class="group-img">
                                    <input type="text" class="form-control" placeholder="Select Location">
                                    <i class="feather-map-pin"></i>
                                </div>
                            </div> -->
                        <div class="filter-content">
                            <h2 class="mb-4">Price Range</h2>
                            <div class="filter-range">
                                <input type="text" id="range_03">
                            </div>
                            <div class="filter-range-amount">
                                <h5>Price: <span>$5 - $210</span></h5>
                            </div>
                        </div>
                        <div class="filter-content">
                            <h2>By Rating <span><i class="feather-chevron-down"></i></span></h2>
                            <ul class="rating-set">
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(35)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(40)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(40)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(20)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(5)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>


                <div class="col-md-9 col-sm-12">
                    <div class="row sorting-div">
                        <div class="col-lg-4 col-sm-12 ">
                            <div class="count-search">
                                <h6>Found 12 Services</h6>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12 d-flex justify-content-end ">
                            <div class="sortbyset">
                                <div class="sorting-select">
                                    <select class="form-control select">
                                        <option>Price Low to High</option>
                                        <option>Price High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid-listview">
                                <ul>
                                    <li>
                                        <a href="service-grid.html" class="active">
                                            <i class="feather-grid"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="service-list.html">
                                            <i class="feather-list"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($subcategories as $subcategory)
                            <div class="col-xl-4 col-md-3">
                                <div class="service-widget servicecontent">
                                    <div class="service-img">
                                        <a href="{{ route('service-details') }}">
                                            <img class="img-fluid serv-img" alt="Service Image"
                                                src="{{ asset('storage/assets/subcategory/' . $subcategory->image ??'') }}">
                                        </a>
                                        <div class="fav-item">
                                            <a href="categories.html"><span class="item-cat">{{ $subcategory->category->name ??'' }}</span></a>
                                            <a href="javascript:void(0)" class="fav-icon">
                                                <i class="feather-heart"></i>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <a href="providers.html"><span class="item-img"><img
                                                        src="assets/img/profiles/avatar-01.jpg" class="avatar"
                                                        alt="User"></span></a>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h3 class="title">
                                            <a href="{{ route('service-details') }}">{{ $subcategory->name ??'' }}</a>
                                        </h3>
                                        <p><i class="feather-map-pin"></i>Maryland City, USA<span class="rate"><i
                                                    class="fas fa-star filled"></i>4.9</span></p>
                                        <div class="serv-info">
                                            <h6>&#8377;{{ $subcategory->total_price ??'' }}
                                                @if ($subcategory->discount != null)
                                                <span class="old-price">&#8377;{{ $subcategory->discounted_price ??'' }}</span>
                                                @endif
                                            </h6>
                                            <a href="{{ route('booking') }}" class="btn btn-book">Book Now</a>

                                        </div>
                                        <div>
                                            <a href="{{ route('booking') }}" class="btn btn-book"
                                                style="width: 100%; margin-top: 2%;">View details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-pagination rev-page">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link page-prev" href="javascript:void(0);" tabindex="-1"><i
                                                    class="fa-solid fa-arrow-left me-1"></i> PREV</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0);">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link page-next" href="javascript:void(0);">NEXT <i
                                                    class="fa-solid fa-arrow-right ms-1"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
