@extends('frontend.layouts.main')

@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Blog</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="blog-details.html"><img class="img-fluid"
                                            src="assets/img/services/service-19.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Computer</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="blog-details.html">How to Fix a Computer in Just 3 Steps?</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae
                                        dicta sunt explicabo.</p>
                                    <a href="{{ route('blog-details') }}" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="blog-details.html"><img class="img-fluid"
                                            src="assets/img/services/service-10.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Construction</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="blog-details.html">Construction Service Scams: How to Avoid
                                            Them</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae
                                        dicta sunt explicabo.</p>
                                    <a href="blog-details.html" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="blog-details.html"><img class="img-fluid"
                                            src="assets/img/services/service-08.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Car Wash</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="blog-details.html">Lorem ipsum dolor sit amet, consectetur sed
                                            do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae
                                        dicta sunt explicabo.</p>
                                    <a href="blog-details.html" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="blog-details.html"><img class="img-fluid"
                                            src="assets/img/services/service-19.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Electrical</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="blog-details.html">Lorem ipsum dolor sit amet, consectetur sed
                                            do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae
                                        dicta sunt explicabo.</p>
                                    <a href="blog-details.html" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="blog-details.html"><img class="img-fluid"
                                            src="assets/img/services/service-09.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Cleaning</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="blog-details.html">Lorem ipsum dolor sit amet, consectetur sed
                                            do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae
                                        dicta sunt explicabo.</p>
                                    <a href="blog-details.html" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="blog-details.html"><img class="img-fluid"
                                            src="assets/img/services/service-07.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Interior</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="blog-details.html">Lorem ipsum dolor sit amet, consectetur sed
                                            do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae
                                        dicta sunt explicabo.</p>
                                    <a href="blog-details.html" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>

    </div>
@endsection
