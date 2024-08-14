@extends('frontend.layouts.main')
 @section('content')
        <div class="bg-img">
            <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg1">
            <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg2">
            <img src="assets/img/bg/feature-bg-03.png" alt="img" class="bgimg3">
        </div>

        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Services</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Service List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


  <div class="row">
        <div class="slider-container">
            <button class="prev" onclick="slideLeft()">&#10094;</button>
            <div class="slider-wrapper">
                <div class="slider">
                    @foreach ($categories as $cat)
                        <div class="slide">
                            <a href=""><img src="{{ asset('storage/assets/icon/' . $cat->icon ?? '') }}"
                                    alt="Quick Booking"><span>{{ $cat->name ?? '' }}</span></a>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="next" onclick="slideRight()">&#10095;</button>
        </div>
    </div>



        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-sm-12 theiaStickySidebar">
                        <div class="filter-div">
                            <div class="filter-head">
                                <h5>Filter by</h5>
                                <a href="#" class="reset-link" onclick="resetVal()" >Reset Filters</a>
                            </div>
                            <div class="filter-content">
                                <h2>Keyword</h2>
                                <input type="text" class="form-control" id="input-keyword" placeholder="What are you looking for?">
                            </div>
                            <div class="filter-content">
                                <h2>Location</h2>
                                <div class="group-img">
                                    <input type="text" class="form-control" placeholder="Select Location" id="location-val">
                                    <i class="feather-map-pin"></i>
                                </div>
                            </div>
                            <div class="filter-content">
                                <h2>Sub Category</h2>
                                <select class="form-control select" id="mySelect">
                                    <option value="AllSubCategory">All Sub Category</option>
                                    <option value="computer">Computer</option>
                                    <option value="construction">Construction1</option>
                                    <option value="construction">Construction2</option>
                                    <option value="construction">Construction3</option>
                                </select>
                            </div>
                            <div class="filter-content">
                                <h2>Categories <span><i class="feather-chevron-down"></i></span></h2>
                                <div class="filter-checkbox" id="fill-more">
                                    <ul>
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox" id="allCategories">
                                                <span><i></i></span>
                                                <b class="check-content">All Categories</b>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                                <span><i></i></span>
                                                <b class="check-content">Construction</b>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                                <span><i></i></span>
                                                <b class="check-content">Car Wash</b>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                                <span><i></i></span>
                                                <b class="check-content">Electrical</b>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                                <span><i></i></span>
                                                <b class="check-content">Cleaning</b>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                                <span><i></i></span>
                                                <b class="check-content">Interior</b>
                                            </label>
                                        </li>

                                    </ul>
                                </div>
                                <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                        class="feather-arrow-down-circle ms-1"></i></a>
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
                                            <input type="checkbox" class="toggleCheckbox" >
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
                                            <input type="checkbox" class="toggleCheckbox">
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
                                            <input type="checkbox" class="toggleCheckbox">
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
                                            <input type="checkbox" class="toggleCheckbox">
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
                                            <input type="checkbox" class="toggleCheckbox">
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


                    <div class="col-lg-8  col-sm-12">
                        <div class="row sorting-div">
                            <div class="col-lg-4 col-sm-12 ">
                                <div class="count-search">
                                    <h6>Found 6 Services</h6>
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
                                            <a href="service-grid.html">
                                                <i class="feather-grid"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="service-list.html" class="active">
                                                <i class="feather-list"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="service-list">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="assets/img/services/service-04.jpg">
                                            </a>
                                            <div class="fav-item">
                                                <a href="javascript:void(0)" class="fav-icon">
                                                    <i class="feather-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">Car Wash</span>
                                            <h5 class="title">
                                                <a href="service-details.html">Car Repair Services</a>
                                            </h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <a href="" class="text-primary">Read more </a>
                                            <div class="service-pro-img d-flex gap-4">
                                                <p><i class="feather-map-pin"></i>Maryland City, MD, USA</p>
                                                <span><i class="fas fa-star filled"></i>4.9</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-action">
                                        <h6>25.00<span class="old-price">35.00</span></h6>
                                        <a href="booking.html" class="btn btn-secondary">Book Now</a>
                                    </div>
                                </div>


                                <div class="service-list">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="assets/img/services/service-04.jpg">
                                            </a>
                                            <div class="fav-item">
                                                <a href="javascript:void(0)" class="fav-icon">
                                                    <i class="feather-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">Car Wash</span>
                                            <h5 class="title">
                                                <a href="service-details.html">Car Repair Services</a>
                                            </h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <a href="" class="text-primary">Read more </a>
                                            <div class="service-pro-img d-flex gap-4">
                                                <p><i class="feather-map-pin"></i>Maryland City, MD, USA</p>
                                                <span><i class="fas fa-star filled"></i>4.9</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-action">
                                        <h6>25.00<span class="old-price">35.00</span></h6>
                                        <a href="booking.html" class="btn btn-secondary">Book Now</a>
                                    </div>
                                </div>

                                <div class="service-list">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="assets/img/services/service-04.jpg">
                                            </a>
                                            <div class="fav-item">
                                                <a href="javascript:void(0)" class="fav-icon">
                                                    <i class="feather-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">Car Wash</span>
                                            <h5 class="title">
                                                <a href="service-details.html">Car Repair Services</a>
                                            </h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <a href="" class="text-primary">Read more </a>
                                            <div class="service-pro-img d-flex gap-4">
                                                <p><i class="feather-map-pin"></i>Maryland City, MD, USA</p>
                                                <span><i class="fas fa-star filled"></i>4.9</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-action">
                                        <h6>25.00<span class="old-price">35.00</span></h6>
                                        <a href="booking.html" class="btn btn-secondary">Book Now</a>
                                    </div>
                                </div>


                                <div class="service-list">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="assets/img/services/service-04.jpg">
                                            </a>
                                            <div class="fav-item">
                                                <a href="javascript:void(0)" class="fav-icon">
                                                    <i class="feather-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">Car Wash</span>
                                            <h5 class="title">
                                                <a href="service-details.html">Car Repair Services</a>
                                            </h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <a href="" class="text-primary">Read more </a>
                                            <div class="service-pro-img d-flex gap-4">
                                                <p><i class="feather-map-pin"></i>Maryland City, MD, USA</p>
                                                <span><i class="fas fa-star filled"></i>4.9</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-action">
                                        <h6>25.00<span class="old-price">35.00</span></h6>
                                        <a href="booking.html" class="btn btn-secondary">Book Now</a>
                                    </div>
                                </div>


                                <div class="service-list">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="assets/img/services/service-04.jpg">
                                            </a>
                                            <div class="fav-item">
                                                <a href="javascript:void(0)" class="fav-icon">
                                                    <i class="feather-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">Car Wash</span>
                                            <h5 class="title">
                                                <a href="service-details.html">Car Repair Services</a>
                                            </h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <a href="" class="text-primary">Read more </a>
                                            <div class="service-pro-img d-flex gap-4">
                                                <p><i class="feather-map-pin"></i>Maryland City, MD, USA</p>
                                                <span><i class="fas fa-star filled"></i>4.9</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-action">
                                        <h6>25.00<span class="old-price">35.00</span></h6>
                                        <a href="booking.html" class="btn btn-secondary">Book Now</a>
                                    </div>
                                </div>


                                <div class="service-list">
                                    <div class="service-cont">
                                        <div class="service-cont-img">
                                            <a href="service-details.html">
                                                <img class="img-fluid serv-img" alt="Service Image"
                                                    src="assets/img/services/service-04.jpg">
                                            </a>
                                            <div class="fav-item">
                                                <a href="javascript:void(0)" class="fav-icon">
                                                    <i class="feather-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-cont-info">
                                            <span class="item-cat">Car Wash</span>
                                            <h5 class="title">
                                                <a href="service-details.html">Car Repair Services</a>
                                            </h5>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quisquam.</p>
                                            <a href="" class="text-primary">Read more </a>
                                            <div class="service-pro-img d-flex gap-4">
                                                <p><i class="feather-map-pin"></i>Maryland City, MD, USA</p>
                                                <span><i class="fas fa-star filled"></i>4.9</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-action">
                                        <h6>25.00<span class="old-price">35.00</span></h6>
                                        <a href="booking.html" class="btn btn-secondary">Book Now</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="blog-pagination rev-page">
                                    <nav>
                                        <ul class="pagination justify-content-center mt-0">
                                            <li class="page-item disabled">
                                                <a class="page-link page-prev" href="javascript:void(0);"
                                                    tabindex="-1"><i class="fa-solid fa-arrow-left me-1"></i> PREV</a>
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