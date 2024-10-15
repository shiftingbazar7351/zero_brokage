@foreach ($cities as $city)
    <div class="col-md-6 mb-4">
        <div class="bangalore-con border-3 border-bottom border-primary rounded p-3 shadow-sm mb-4">
            <a href="{{ route('services-in-india', $city->name ?? '') }}" class="text-decoration-none text-dark">
                <h4 class="text-uppercase mb-2">{{ $subcategory->slug ?? '' }} {{ strtoupper($city->name) }}</h4>
            </a>
            @if ($vendors)
                <p class="text-muted">{!! Str::limit($vendors->description, 300, '...') !!}</p>
            @else
                <p class="text-muted">No description available.</p>
            @endif
        </div>
    </div>
@endforeach
