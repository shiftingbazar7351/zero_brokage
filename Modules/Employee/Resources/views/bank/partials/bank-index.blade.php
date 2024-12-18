<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Bank Name</th>
            @can('employee-bank-status')
            <th>Status</th>
            @endcan
            @canany(['employee-bank-edit', 'employee-bank-delete', 'employee-bank-show'])
                <th>Action</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @forelse ($banks as $bank)
            <tr>
                <td>{{ $bank->id ?? '' }}</td>
                <td>{{ $bank->bank_name ??'' }}</td>
                @can('employee-bank-status')
                <td>
                    <div class="active-switch">
                        <label class="switch">
                            <input type="checkbox" class="status-toggle"
                                data-id="{{ $bank->id }}"
                                onclick="return confirm('Are you sure want to change status?')"
                                {{ $bank->status ? 'checked' : '' }}>
                            <span class="sliders round"></span>
                        </label>
                    </div>
                </td>
                @endcan
                @canany(['employee-bank-edit', 'employee-bank-delete', 'employee-bank-show'])
                    <td>
                        <div class="d-flex">
                            <a class="btn delete-table me-2 edit-service"
                                href="{{ route('employee-bank.show', $bank->id) }}">
                                <i class="fe fe-eye"></i>
                            </a>

                            <a class="btn delete-table me-2 edit-service"
                                href="{{ route('employee-bank.edit', $bank->id) }}">
                                <i class="fe fe-edit"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('employee-bank.destroy', $bank->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this Bank?');">
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
