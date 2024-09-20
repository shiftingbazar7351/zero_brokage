<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            @can('submenu-status')
                <th>Status</th>
            @endcan
            @can(['submenu-edit', 'submenu-delete'])
                <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @if ($submenus->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($submenus as $subcategory)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subcategory->name }}</td>

                    <td>
                        @if ($subcategory->image)
                            <img src="{{ Storage::url('submenu/' . $subcategory->image) }}"
                                class="img-thumbnail" width="50px">
                        @else
                            No Image
                        @endif
                    </td>
                    @can('submenu-status')
                        <td>
                            <div class="active-switch">
                                <label class="switch">
                                    <input type="checkbox" class="status-toggle"
                                        data-id="{{ $subcategory->id }}"
                                        {{ $subcategory->status ? 'checked' : '' }}>
                                    <span class="sliders round"></span>
                                </label>
                            </div>
                        </td>
                    @endcan
                    @can(['submenu-edit', 'submenu-delete'])
                        <td>
                            <div class="d-flex" style="justify-content: center">
                                <button class="btn delete-table me-2"
                                    onclick="editCategory({{ $subcategory->id }})" type="button"
                                    data-bs-toggle="modal" data-bs-target="#edit-category">
                                    <i class="fe fe-edit"></i>
                                </button>


                                <!-- Delete Button -->
                                <form action="{{ route('submenu.destroy', $subcategory->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-table"
                                        onclick="return confirm('Are you sure you want to delete this Sub Menu?');">
                                        <i class="fe fe-trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    @endcan
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
