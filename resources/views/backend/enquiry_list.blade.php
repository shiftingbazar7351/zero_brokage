@extends('backend.layouts.main')
@section('content')

    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Enquiry Listing</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <a href="{{ route('enquiry.create') }}" class="btn btn-primary mb-3">
                                Add Enquiry
                            </a>
                            
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="table-resposnive table-div">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>move from origin</th>
                                    <th>move from destination</th>
                                    <th>Date</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($enquiries->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($enquiries as $enquiry)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $enquiry->name }}</td>

                                            <td>
                                                {{ $enquiry->move_from_origin }}
                                            </td>

                                            <td>
                                                {{ $enquiry->move_from_destination }}
                                            </td>

                                            <td>
                                                @php
                                                    $date = \Carbon\Carbon::parse($enquiry->date_time);
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
                                            
                                            
                                            <td>{{ $enquiry->email }}</td>
                                            <td>{{ $enquiry->mobile_number }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection