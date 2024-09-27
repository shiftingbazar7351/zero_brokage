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
                    <h1 class="text-center">Salary Details</h1>
                    <div class="col-md-12">
                        <table class="table table-sm table-bordered table-striped">

                            <tbody>
                                <tr>
                                    <th scope="row">Basic Salary</th>
                                    <td class="text-wrap"> {{ $salary->basic_salary  ?? '' }}  </td>
                                </tr>
                                <tr>
                                    <th scope="row">House rent</th>
                                    <td class="text-wrap"> {{ $salary->house_rent_allowance ?? ''}}  </td>
                                </tr>
                                <tr>
                                    <th scope="row">Conveyance allowance</th>
                                    <td class="text-wrap">{{ $salary->conveyance_allowance ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Other allowance</th>
                                    <td class="text-wrap">{{ $salary->other_allowance ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Personal pay</th>
                                    <td class="text-wrap">{{ $salary->other_allowance ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Food allowance</th>
                                    <td class="text-wrap">{{ $salary->food_allowance ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Medical allowance</th>
                                    <td class="text-wrap">{{ $salary->medical_allowance ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Telephone allowance</th>
                                    <td class="text-wrap">{{ $salary->telephone_allowance ?? '' }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

