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
                    <h1 class="text-center">Employee Details</h1>
                    <div class="col-md-4">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td class="text-wrap"> alex </td>

                                </tr>
                                <tr>
                                    <th scope="row">Number :</th>
                                    <td class="text-wrap"> 1234567890 </td>
                                </tr>
                                <tr>
                                    <th scope="row">Adress</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">Lorem, ipsum d asperiores iste dolore quasi dolores hic ut officia libero.</td>
                                </tr>
                                <tr>
                                    <th scope="row">city</th>
                                    <td class="text-wrap">noidas</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pin Code</th>
                                    <td class="text-wrap">34563</td>
                                </tr>
                                <tr>
                                    <th scope="row">Visiting Card</th>
                                    <td style="text-align: center">
                                        <img src="{{ asset('assets/img/service-img-10.jpg') }}" alt="" style="width: 120px;">
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

