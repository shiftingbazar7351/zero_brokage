@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="container-fluid">
                <div class="row mx-auto">
                    <h1 class="text-center">Enquiry Details</h1>
                    <div class="col-md-4">
                        <table class="table table-sm table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td class="text-wrap">{{ $enquirys->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Number :</th>
                                    <td class="text-wrap">{{ $enquirys->mobile_number ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td class="text-wrap">{{ $enquirys->email ?? ''}}</td>
                                </tr>


                            </tbody>

                        </table>
                    </div>

                    <div class="col-md-4">
                        <table class="table table-sm table-bordered table-striped">
                            <tbody>


                                <tr>
                                    <th scope="row">category</th>
                                    <td class="text-wrap">{{ $enquirys->categoryName->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sub-Category</th>
                                    <td class="text-wrap">{{ $enquirys->subcategory->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Menu</th>
                                    <td class="text-wrap">{{ $enquirys->menu->name ?? '' }}</td>
                                </tr>


                            </tbody>

                        </table>
                    </div>

                    <div class="col-md-4">
                        <table class="table table-sm table-bordered table-striped">
                            <tbody>

                                <tr>
                                    <th scope="row">Sub-Menu</th>
                                    <td class="text-wrap">{{ $enquirys->submenu->name ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Date</th>
                                    <td class="text-wrap">{{ \Carbon\Carbon::parse($enquirys->date_time)->format('j-M-Y') ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Created At</th>
                                    <td>
                                        @php
                                            $date = \Carbon\Carbon::parse($enquirys->created_at);
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

                </div>
            </div>
        </div>
    </div>
@endsection
