@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="container-fluid">
                <div class="row mx-auto">
                    <h1 class="text-center">Products Details</h1>
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td class="text-wrap">{{ $products->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Price :</th>
                                    <td class="text-wrap">{{ $products->price ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td class="text-wrap">{{ $products->description ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Created At</th>
                                    <td>
                                        @php
                                            $date = \Carbon\Carbon::parse($products->created_at);
                                        @endphp
                                        @if ($date->isToday())
                                            <span class="badge bg-success">Today</span>
                                        @elseif ($date->isYesterday())
                                            <span class="badge bg-warning text-dark">Yesterday</span>
                                        @elseif ($date->isTomorrow())
                                            <span class="badge bg-primary">Tomorrow</span>
                                        @else
                                            {{ $date->format('d-m-Y') }}
                                        @endif
                                    </td>
                                </tr>


                            </tbody>

                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-sm table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Category :</th>

                                    <td class="text-wrap">
                                        @foreach ($categories as $key => $category)
                                            {{ $category->name }}@if ($key + 1 < count($categories)), @endif
                                        @endforeach
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <th scope="row">Sub Category :</th>
                                    <td class="text-wrap">
                                        @foreach ($subcategories as $key => $subcategory)
                                            {{ $subcategory->name }}@if ($key + 1 < count($subcategories)), @endif
                                        @endforeach
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Menu</th>
                                    <td class="text-wrap">
                                        @foreach ($menus as $key => $menu)
                                            {{ $menu->name }}@if ($key + 1 < count($menus)), @endif
                                        @endforeach
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Sub Menu</th>
                                    <td class="text-wrap">
                                        @foreach ($submenus as $key => $submenu)
                                            {{ $submenu->name }}@if ($key + 1 < count($submenus)), @endif
                                        @endforeach
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Created By</th>
                                    <td>
                                    <td class="text-wrap">{{ $products->createdBy->name ?? '' }}</td>
                                    </td>
                                </tr>


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
