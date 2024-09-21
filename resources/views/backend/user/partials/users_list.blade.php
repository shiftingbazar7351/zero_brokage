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
@if ($users->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        <!-- Showing X to Y of Z entries -->
        <div>
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <!-- Previous Button -->
                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                <!-- Page numbers with ellipsis -->
                @foreach (range(1, $users->lastPage()) as $i)
                    @if ($i == 1 || $i == $users->lastPage() || abs($i - $users->currentPage()) <= 2)
                        <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 2 || $i == $users->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endforeach

                <!-- Next Button -->
                <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endif
