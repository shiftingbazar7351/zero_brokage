@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="container-fluid">
                <div class="row mx-auto" style="background-color: rgb(236, 236, 236)">
                    <h1 class="text-center">Service Details</h1>
                    <div class="col-lg-12">
                        <table class="table table-sm">

                            <tbody>
                                @forelse ($vendors as $vendor)
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
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data found</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
