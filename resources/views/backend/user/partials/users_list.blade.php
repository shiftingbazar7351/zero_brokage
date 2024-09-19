<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            @if ($user->user_type !== 'super_admin')
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name ?? '' }}</td>
                    <td>{{ $user->email ?? '' }}</td>
                    <td>{{ $user->user_type ?? '' }}</td>
                    <td>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" class="status-toggle"
                                    data-id="{{ $user->id }}"
                                    onclick="return confirm('Are you sure want to change status?')"
                                    {{ $user->status ? 'checked' : '' }}>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="table-actions d-flex justify-content-center">
                            <button class="btn delete-table me-2"
                                onclick="editUser({{ $user->id }})" type="button"
                                data-bs-toggle="modal" data-bs-target="#edit-user">
                                <i class="fe fe-edit"></i>
                            </button>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn delete-table" type="submit"
                                    onclick="return confirm('Are you sure want to delete this?')">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination Links --}}
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($users->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
