<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            {{-- <th>Location</th> --}}
            <th>category</th>
            <th>Sub category</th>
            <th>Menu</th>
            <th>Sub menu</th>
            <th>Date</th>
            <th>Email</th>
            <th>Mobile</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($enquiries->isEmpty())
            <tr>
                <td colspan="12" class="text-center">No data found</td>
            </tr>
        @else
            @foreach ($enquiries as $enquiry)
                <tr>
                    <td>{{ $enquiry->id ??'' }}</td>
                    <td>{{ $enquiry->name }}</td>
                    {{-- <td>{{ $enquiry->move_from_origin }}</td> --}}
                    <td>{{ $enquiry->categoryName->name ??'' }}</td>
                    <td>{{ $enquiry->subcategory->name ??'' }}</td>
                    <td>{{ $enquiry->menu->name ??'' }}</td>
                    <td>{{ $enquiry->submenu->name ??'' }}</td>

                    <td>
                        @php
                            $date = \Carbon\Carbon::parse($enquiry->date_time);
                        @endphp
                        @if ($date->isToday())
                            <span class="badge bg-success">Today</span>
                        @elseif ($date->isYesterday())
                            <span class="badge bg-warning text-dark">Yesterday</span>
                        @elseif ($date->isTomorrow())
                            <span class="badge bg-primary">Tomorrow</span>
                        @else
                            {{ $date->format('d-m-Y') }}
                        @endif
                    </td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{{ $enquiry->mobile_number }}</td>
                    <td>
                        <div class="d-flex" style="justify-content: center">

                            <a class="btn delete-table me-2 edit-service"
                                href="{{ route('enquiry.show', $enquiry->id) }}">
                                <i class="fe fe-eye"></i>
                            </a>



                            <button class="btn delete-table me-2"
                                onclick="editEnquiry({{ $enquiry->id }}, '{{ $enquiry->name }}', '{{ $enquiry->email }}', '{{ $enquiry->mobile_number }}', '{{ $enquiry->move_from_origin }}', '{{ $enquiry->date_time }}')"
                                type="button" data-bs-toggle="modal"
                                data-bs-target="#edit-enquiry">
                                <i class="fe fe-edit"></i>
                            </button>

                            <form action="{{ route('enquiry.destroy', $enquiry->id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-table"
                                    onclick="return confirm('Are you sure you want to delete this sub-category?');">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
