<table class="table datatable table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Ip Address</th>
            <th>Created By</th>
            @can('ipaddress-status')
                <th>Status</th>
            @endcan
            @canany(['ipaddress-edit', 'ipaddress-delete'])
                <th>Action</th>
            @endcanany
        </tr>
    </thead>
    @foreach ($ipaddresses as $ipaddress)
        <tbody>
            <td>{{ $ipaddress->id ?? '' }}</td>
            <td>{{ $ipaddress->ip_address ?? '' }}</td>
            <td>{{ $ipaddress->createdBy->name ?? '' }}</td>
            @can('ipaddress-status')
                <td>
                    <div class="active-switch">
                        <label class="switch">
                            <input type="checkbox" class="status-toggle" data-id="{{ $ipaddress->id }}"
                                {{ $ipaddress->status ? 'checked' : '' }}>
                            <span class="sliders round"></span>
                        </label>
                    </div>
                </td>
            @endcan
            @canany(['ipaddress-edit', 'ipaddress-delete'])
                <td>
                    <div class="table-actions d-flex justify-content-center">
                        <button class="btn delete-table me-2" onclick="editCategory({{ $ipaddress->id }})" type="button"
                            data-bs-toggle="modal" data-bs-target="#edit-category">
                            <i class="fe fe-edit"></i>
                        </button>
                        <form action="{{ route('ipaddress.destroy', $ipaddress->id) }}" method="POST"
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
            @endcanany
        </tbody>
    @endforeach
</table>
