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
                    <h1 class="text-center">Bank Details</h1>
                    <div class="col-md-12">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Bank Name </th>
                                    <td class="text-wrap"> {{ $bank->bank_name }} </td>

                                </tr>
                                <tr>
                                    <th scope="row">Employee Name</th>
                                    <td class="text-wrap"> {{ $bank->emp_id }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Account Number</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">{{ $bank->account_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Permanent Account Number</th>
                                    {{-- <td class="text-wrap">{{ $vendor->address  }}</td> --}}
                                    <td class="text-wrap">{{ $bank->permanent_acc_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Branch</th>
                                    <td class="text-wrap">{{ $bank->branch }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Band</th>
                                    <td class="text-wrap">{{ $bank->band }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">UAN Number</th>
                                    <td class="text-wrap">{{ $bank->uan }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

