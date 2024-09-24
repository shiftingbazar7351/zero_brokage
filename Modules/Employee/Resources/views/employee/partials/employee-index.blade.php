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
                <td>{{ $employee->id ??'' }}</td>
                <td>{{ $employee->name??''}}</td>
                <td>{{ $employee->company??''}}</td>
                <td>{{ $employee->email ??''}}</td>
                <td>{{ $employee->department ??''}}</td>
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
                <td colspan="12" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>
