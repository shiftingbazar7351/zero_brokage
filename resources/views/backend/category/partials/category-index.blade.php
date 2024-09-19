 <table class="table datatable table-striped text-center table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    @can('categories-status')
                                    <th>Status</th>
                                    @endcan
                                    @can(['categories-edit', 'categories-delete'])
                                    <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @else
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="table-imgname">
                                                    <span>{{ $category->name }}</span>
                                                </div>
                                            </td>
                                            @can('categories-status')
                                                <td>
                                                    <div class="active-switch">
                                                        <label class="switch">
                                                            <input type="checkbox" class="status-toggle"
                                                                data-id="{{ $category->id }}"
                                                                onclick="return confirm('Are you sure want to change status?')"
                                                                {{ $category->status ? 'checked' : '' }}>
                                                            <span class="sliders round"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            @endcan
                                            @can(['categories-edit', 'categories-delete'])
                                                <td>
                                                    <div class="table-actions d-flex justify-content-center">
                                                        @can('categories-edit')
                                                            <button class="btn delete-table me-2"
                                                                onclick="editCategory({{ $category->id }}, '{{ $category->name }}')"
                                                                type="button" data-bs-toggle="modal"
                                                                data-bs-target="#edit-category">
                                                                <i class="fe fe-edit"></i>
                                                            </button>
                                                        @endcan
                                                        @can('categories-delete')
                                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn delete-table" type="submit"
                                                                    onclick="return confirm('Are you sure want to delete this?')">
                                                                    <i class="fe fe-trash-2"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
