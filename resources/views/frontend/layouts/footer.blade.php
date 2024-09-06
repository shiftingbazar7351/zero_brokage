<footer class="footer">
    <div class="footer-top aos" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">

                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logofinal.png') }}" alt="logo"></a>
                        </div>
                        <div class="footer-content">
                            <p>Your satisfaction is our priority. Reach out to us anytime. </p>
                        </div>

                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">Quick Links</h2>
                        <ul>
                            <li>
                                <a href="javascript:void(0);">About Us</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Blogs</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Contact Us</a>
                            </li>
                            <li>
                                <a href="provider-signup.html">Become a Professional</a>
                            </li>
                            <li>
                                <a href="user-signup.html">Become a User</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">Contact Us</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address">
                                <p><span><i class="feather-map-pin"></i></span> VILL HOSHIYARPUR HOSHIYARPUR C/O-SUSHIL YADAV NOIDA Gautam Buddha Nagar UP 201307 IN</p>
                            </div>
                            <p><span><i class="feather-phone"></i></span> 09429690472</p>
                            <p class="mb-0"><span><i class="feather-mail"></i></span>
                                zerobrokage@gmail.com
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget">
                        <h2 class="footer-title">Follow Us</h2>
                        <div class="social-icon">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-facebook"></i> </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fab fa-twitter"></i> </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                        <h2 class="footer-subtitle">Newsletter Signup</h2>
                        <div class="subscribe-form">
                            <form action="{{ route('newsletter.store') }}" method="POST">
                            @csrf
                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address">
                                <button type="submit" class="btn footer-btn">
                                    <i class="feather-send"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="footer-bottom">
        <div class="container">

            <div class="copyright">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="copyright-text">
                            <p class="mb-0"> &copy;2024 Copyright Flybizz.com. All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="payment-image">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/payment/visa.png') }}"
                                            alt="img"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><img
                                            src="{{ asset('assets/img/payment/mastercard.png') }}" alt="img"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><img
                                            src="{{ asset('assets/img/payment/stripe.png') }}" alt="img"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><img
                                            src="{{ asset('assets/img/payment/discover.png') }}" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="copyright-menu">
                            <ul class="policy-menu">
                                <li>
                                    <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="{{ route('term-condition') }}">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
