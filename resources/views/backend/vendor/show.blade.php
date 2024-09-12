@extends('backend.layouts.main')
@section('styles')
<style>
    .image-container {
        position: relative;
        display: inline-block;
    }

    .small-image {
        width: 100px;
        /* Adjust as needed */
        height: auto;
        transition: transform 0.3s ease;
        /* Smooth transition effect */
    }

    .image-container:hover .small-image {
        width: 200px;
        /* Adjust as needed for medium size */
    }
</style>
@endsection
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="text-center">Service Details</h1>
                    <div class="col-md-4">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td class="text-wrap"> {{ $vendor->vendor_name  }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Number :</th>
                                    <td class="text-wrap"> {{ $vendor->number  }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Adress</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">Lorem, ipsum d asperiores iste dolore quasi dolores hic ut officia libero.</td>
                                </tr>
                                <tr>
                                    <th scope="row">city</th>
                                    <td class="text-wrap">{{ $vendor->city  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pin Code</th>
                                    <td class="text-wrap">{{ $vendor->pincode  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Visiting Card</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/vendor/visiting_card/' . $vendor->visiting_card) }}" alt="" style="width: 120px;">
                                        <a href="{{ asset('storage/vendor/visiting_card/' . $vendor->visiting_card) }}" target="_blank" style="display: block">Visiting Card</a>
                                    </td>
                                </tr>
                                {{-- @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data found</td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td class="text-wrap"> {{ $vendor->vendor_name  }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Number :</th>
                                    <td class="text-wrap"> {{ $vendor->number  }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Adress</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">Lorem, ipsum dol maxime a mae dolore quasi dolores hic ut officia libero.</td>
                                </tr>
                                <tr>
                                    <th scope="row">city</th>
                                    <td class="text-wrap">{{ $vendor->city  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pin Code</th>
                                    <td class="text-wrap">{{ $vendor->pincode  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Visiting Card</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/vendor/visiting_card/' . $vendor->visiting_card) }}" alt="" style="width: 120px;">
                                        <a href="{{ asset('storage/vendor/visiting_card/' . $vendor->visiting_card) }}" target="_blank" style="display: block">Visiting Card</a>
                                    </td>
                                </tr>
                                {{-- @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data found</td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td class="text-wrap"> {{ $vendor->vendor_name  }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Number :</th>
                                    <td class="text-wrap"> {{ $vendor->number  }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Adress</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">Lorem, dolore quasi dolores hic ut officia libero.</td>
                                </tr>
                                <tr>
                                    <th scope="row">city</th>
                                    <td class="text-wrap">{{ $vendor->city  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pin Code</th>
                                    <td class="text-wrap">{{ $vendor->pincode  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Visiting Card</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('storage/vendor/visiting_card/' . $vendor->visiting_card) }}" alt="" style="width: 120px;">
                                        <a href="{{ asset('storage/vendor/visiting_card/' . $vendor->visiting_card) }}" target="_blank" style="display: block">Visiting Card</a>
                                    </td>
                                </tr>
                                {{-- @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data found</td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="col-md-3">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td class="text-wrap"> {{ $vendor->vendor_name ?? '' }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">Number :</th>
                                    <td class="text-wrap"> {{ $vendor->number  }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Adress</th>
                                    <td class="text-wrap">{{ $vendor->address  }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">city</th>
                                    <td class="text-wrap">{{ $vendor->city  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pin Code</th>
                                    <td class="text-wrap">{{ $vendor->pincode  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Image</th>
                                    <td style="text-align: center">
                                        <img src="{{asset('assets/img/services/AC_Cleaning.jpg')}}" alt="" style="width: 120px;">
                                        <a href="https://www.w3schools.com" target="_blank" style="display: block">Visit W3Schools</a>
                                    </td>
                                </tr> --}}
                                {{-- @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data found</td>
                                </tr> --}}
{{--
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

