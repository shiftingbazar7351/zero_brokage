@if ($submenus && $submenus->isNotEmpty())
    @foreach ($submenus as $menu)
        <!-- Repeat the HTML structure of the service list here -->
        <div class="service-list shadow-sm">
            <div class="service-cont">
                <div class="service-cont-img">
                    <a href="service-details.html">
                        <img class="img-fluid serv-img" alt="Service Image"
                            src="{{ asset('storage/submenu/' . $menu->image ?? '') }}">
                    </a>
                </div>
                <div class="service-cont-info">
                    <span class="item-cat">{{ ucwords($menu->menu->name) ?? '' }}</span>
                    <h5 class="title"><a href="service-details.html">{{ $menu->name ?? '' }}</a></h5>
                    <p>{{ $menu->description ?? '' }}</p>
                    <a href="#" class="text-primary text-decoration-underline" data-bs-toggle="modal"
                        data-bs-target="#modal-{{ $menu->id }}">View
                        Details</a>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-{{ $menu->id }}" tabindex="-1"
                        aria-labelledby="modalLabel-{{ $menu->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-{{ $menu->id }}">
                                        Service Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $menu->details ?? 'No Data Found' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-pro-img d-flex gap-4">
                        <p><i class="feather-map-pin"></i>
                            {{ ucwords($menu->cityName->name ?? '') }},
                            {{ ucwords($menu->cityName->state->name ?? '') }}
                        </p>
                    </div>

                    <!-- Modal and other details -->
                </div>
            </div>
            <div class="service-action">
                <h6>&#8377;{{ $menu->discounted_price ?? '' }}<span class="old-price">&#8377;
                        {{ $menu->total_price ?? '' }}</span></h6>
                <a class="btn btn-secondary book-Now-btn">Book Now</a>
            </div>
        </div>
    @endforeach
    @else
    <div class="text-center">
        <img class="align-item-center" src="https://tycove.com/public/assets/images/no-data-found.svg" alt="No Data Found" style="margin-top: 50px;">
        <div style="color: #6978dd; margin-top: 20px;">
            <b>No Data Found</b>
        </div>
    </div>
@endif
