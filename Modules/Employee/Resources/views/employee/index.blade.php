@extends('backend.layouts.main')
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Vendors</h5>

                <div class="list-btn d-flex gap-3">

                    <div class="page-headers">
                        <div class="search-bar">
                            <span><i class="fe fe-search"></i></span>
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                    </div>
                    @can('employee-create')
                        <ul>
                            <li>
                                <button class="btn btn-primary" type="button"
                                    onclick="window.location='{{ route('employee.create') }}'">
                                    <i class="fa fa-plus me-2"></i>Add Employee
                                </button>
                            </li>
                        </ul>
                    @endcan
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    @canany(['employee-edit', 'employee-delete', 'employee-show'])
                                        <th>Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->fname}}</td>
                                        <td>{{ $employee->company}}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->department }}</td>
                                        @canany(['employee-edit', 'employee-delete', 'employee-show'])
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn delete-table me-2 edit-service"
                                                        href="{{ route('employee.show', $employee->id) }}">
                                                        <i class="fe fe-eye"></i>
                                                    </a>

                                                    <a class="btn delete-table me-2 edit-service"
                                                        href="{{ route('employee.edit', $employee->id) }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn delete-table"
                                                            onclick="return confirm('Are you sure you want to delete this Employee?');">
                                                            <i class="fe fe-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endcanany
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
