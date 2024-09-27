<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            @canany(['employee-salary-edit', 'employee-salary-delete', 'employee-salary-show'])
                <th>Action</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @forelse ($salaries as $salary)
            <tr>
                <td>{{ $salary->id ?? '' }}</td>
                <td>{{ $salary->basic_salary ?? ''}}</td>

                @canany(['employee-salary-edit', 'employee-salary-delete', 'employee-salary-show'])
                    <td>
                        <div class="d-flex">
                            <a class="btn delete-table me-2 edit-service"
                                href="{{ route('employee-salary.show', $salary->id) }}">
                                <i class="fe fe-eye"></i>
                            </a>
                            <a class="btn delete-table me-2 edit-service"
                                href="{{ route('employee-salary.edit', $salary->id) }}">
                                <i class="fe fe-edit"></i>
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('employee-salary.destroy', $salary->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this Salary?');">
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
