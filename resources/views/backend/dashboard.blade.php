@extends('backend.layouts.main')
@section('content')
<div class="page-wrapper">

    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12 d-flex widget-path widget-service">
                <div class="card">
                    <div class="card-body">
                        <div class="home-user">
                            <div class="home-userhead">
                                <div class="home-usercount">
                                    <span><img src="{{asset('admin/assets/img/icons/user.svg')}}" alt="img"></span>
                                    <h6>User</h6>
                                </div>
                                <div class="home-useraction">
                                    <a class="delete-table bg-white" href="javascript:void(0);"
                                        data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                        <li>
                                            <a href="user-list.html" class="dropdown-item"> View</a>
                                        </li>
                                        <li>
                                            <a href="edit-user.html" class="dropdown-item"> Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="home-usercontent">
                                <div class="home-usercontents">
                                    <div class="home-usercontentcount">
                                        <img src="{{asset('admin/assets/img/icons/arrow-up.svg')}}" alt="img" class="me-2">
                                        <span class="counters" data-count="30">30</span>
                                    </div>
                                    <h5> Current Month</h5>
                                </div>
                                <div class="homegraph">
                                    <img src="{{asset('admin/assets/img/graph/graph1.png')}}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex widget-path widget-service">
                <div class="card">
                    <div class="card-body">
                        <div class="home-user home-provider">
                            <div class="home-userhead">
                                <div class="home-usercount">
                                    <span><img src="{{asset('admin/assets/img/icons/user-circle.svg')}}" alt="img"></span>
                                    <h6>Providers</h6>
                                </div>
                                <div class="home-useraction">
                                    <a class="delete-table bg-white" href="javascript:void(0);"
                                        data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                        <li>
                                            <a href="providers.html" class="dropdown-item"> View</a>
                                        </li>
                                        <li>
                                            <a href="edit-provider.html" class="dropdown-item"> Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="home-usercontent">
                                <div class="home-usercontents">
                                    <div class="home-usercontentcount">
                                        <img src="{{asset('admin/assets/img/icons/arrow-up.svg')}}" alt="img" class="me-2">
                                        <span class="counters" data-count="25">25</span>
                                    </div>
                                    <h5> Current Month</h5>
                                </div>
                                <div class="homegraph">
                                    <img src="{{asset('admin/assets/img/graph/graph2.png')}}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex widget-path widget-service">
                <div class="card">
                    <div class="card-body">
                        <div class="home-user home-service">
                            <div class="home-userhead">
                                <div class="home-usercount">
                                    <span><img src="{{asset('admin/assets/img/icons/service.svg')}}" alt="img"></span>
                                    <h6>Service</h6>
                                </div>
                                <div class="home-useraction">
                                    <a class="delete-table bg-white" href="javascript:void(0);"
                                        data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                        <li>
                                            <a href="services.html" class="dropdown-item"> View</a>
                                        </li>
                                        <li>
                                            <a href="edit-service.html" class="dropdown-item"> Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="home-usercontent">
                                <div class="home-usercontents">
                                    <div class="home-usercontentcount">
                                        <img src="{{asset('admin/assets/img/icons/arrow-up.svg')}}" alt="img" class="me-2">
                                        <span class="counters" data-count="18">18</span>
                                    </div>
                                    <h5> Current Month</h5>
                                </div>
                                <div class="homegraph">
                                    <img src="{{asset('admin/assets/img/graph/graph3.png')}}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex widget-path widget-service">
                <div class="card">
                    <div class="card-body">
                        <div class="home-user home-subscription">
                            <div class="home-userhead">
                                <div class="home-usercount">
                                    <span><img src="{{asset('admin/assets/img/icons/money.svg')}}" alt="img"></span>
                                    <h6>Subscription</h6>
                                </div>
                                <div class="home-useraction">
                                    <a class="delete-table bg-white" href="javascript:void(0);"
                                        data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                        <li>
                                            <a href="membership.html" class="dropdown-item"> View</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item"> Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="home-usercontent">
                                <div class="home-usercontents">
                                    <div class="home-usercontentcount">
                                        <img src="{{asset('admin/assets/img/icons/arrow-up.svg')}}" alt="img" class="me-2">
                                        <span class="counters" data-count="650">$650</span>
                                    </div>
                                    <h5> Current Month</h5>
                                </div>
                                <div class="homegraph">
                                    <img src="{{asset('admin/assets/img/graph/graph4.png')}}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-12 d-flex  widget-path">
                <div class="card">
                    <div class="card-body">
                        <div class="home-user">
                            <div class="home-head-user">
                                <h2>Revenue</h2>
                                <div class="home-select">
                                    <div class="dropdown">
                                        <button class="btn btn-action btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Monthly
                                        </button>
                                        <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown">
                                        <a class="delete-table bg-white" href="javascript:void(0);"
                                            data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"> View</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"> Edit</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="chartgraph">
                                <div id="chart-view"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12 d-flex  widget-path">
                <div class="card">
                    <div class="card-body">
                        <div class="home-user">
                            <div class="home-head-user">
                                <h2>Booking Summary</h2>
                                <div class="home-select">
                                    <div class="dropdown">
                                        <button class="btn btn-action btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Monthly
                                        </button>
                                        <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown">
                                        <a class="delete-table bg-white" href="javascript:void(0);"
                                            data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu" data-popper-placement="bottom-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"> View</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"> Edit</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="chartgraph">
                                <div id="chart-booking"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->

    </div>
</div>
@endsection
