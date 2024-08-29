@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Newsletters</h5>
                <div class="list-btn d-flex gap-3">

                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-resposnive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($newsletters as $newsletter)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $newsletter->email ?? '' }}</td>
                                        @php
                                        $createdAt = $newsletter->created_at;
                                        $formattedDate = '';

                                        if ($createdAt->isToday()) {
                                            $formattedDate = '<span class="badge bg-primary">Today</span>';
                                        } elseif ($createdAt->isYesterday()) {
                                            $formattedDate = '<span class="badge bg-secondary">Yesterday</span>';
                                        } else {
                                            $formattedDate = $createdAt->format('d M Y');
                                        }
                                    @endphp

                                    <td>{!! $formattedDate !!}</td>


                                        <td>
                                            <div class="table-actions">

                                                <form action="{{ route('newsletter.destroy', $newsletter->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn delete-table" type="subm it"
                                                        onclick="return confirm('Are you sure want to delete this?')">
                                                        <i class="fe fe-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data found</td>
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

