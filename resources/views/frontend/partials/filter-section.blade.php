<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="col-lg-3 col-sm-12 theiaStickySidebar">
    <div class="filter-div">
        <div class="filter-head">
            <h5>Filter by</h5>
            <a href="javascript:void(0);" class="reset-link" onclick="resetVal()">Reset Filters</a>
        </div>
        <div class="filter-content">
            <h2>Keyword</h2>
            <input type="text" class="form-control" id="input-keyword" name="keyword"
                placeholder="What are you looking for?">
        </div>

        <div class="filter-content">
            <h2>Location</h2>
            <div class="dropdown">
                <div class="group-img" style="position: relative; display:block;">
                    <input type="text" placeholder="Search.." id="myInput" name="location"
                        onkeyup="filterFunction()" class="form-control" style="font-size: small; padding-right: 30px;">
                    <i class="fa fa-map-marker" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);"></i>
                </div>
                <div id="myDropdown" class="dropdown-content">
                    @foreach ($cities as $city)
                        <div onclick="selectOption('{{ ucwords($city->name) }}, {{ ucwords($city->state->name ?? '') }}')"
                            style="font-size: small;">
                            {{ ucwords($city->name) }}, {{ ucwords($city->state->name ?? '') }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="filter-content">
            <h2>Categories</h2>
            <div class="filter-checkbox" id="fill-more">
                <ul>
                    <li>
                        <label class="checkboxs">
                            <input type="checkbox" class="toggleCheckbox" id="allCategories">
                            <span><i></i></span>
                            <b class="check-content">All Categories</b>
                        </label>
                    </li>
                    @foreach ($menus as $subcategory)
                        <li>
                            <label class="checkboxs">
                                <input type="checkbox" class="toggleCheckbox categoryCheckbox">
                                <span><i></i></span>
                                <b class="check-content">{{ $subcategory->name ?? '' }}</b>
                            </label>
                        </li>
                    @endforeach
                </ul>
                {{-- <a href="javascript:void(0);" id="more" class="more-view">View More <i
                    class="feather-arrow-down-circle ms-1"></i></a> --}}
            </div>
            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                    class="feather-arrow-down-circle ms-1"></i></a>
        </div>

        <div class="filter-content">
            <h2>Experince <span><i class="feather-chevron-down"></i></span></h2>
            <div class="filter-checkbox" id="fill-more">
                <ul>
                    <li>
                        <label class="checkboxs">
                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                            <span><i></i></span>
                            <b class="check-content">1 years - 5 years</b>
                        </label>
                    </li>
                    <li>
                        <label class="checkboxs">
                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                            <span><i></i></span>
                            <b class="check-content">6 years - 10 years</b>
                        </label>
                    </li>
                    <li>
                        <label class="checkboxs">
                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                            <span><i></i></span>
                            <b class="check-content">11 years - 15 years</b>
                        </label>
                    </li>
                    <li>
                        <label class="checkboxs">
                            <input type="checkbox" class="toggleCheckboxIndia" id="allCategories">
                            <span><i></i></span>
                            <b class="check-content">15 years - 20 years</b>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        {{-- <button class="btn btn-primary" id="search-button">Search</button> --}}
    </div>
</div>
