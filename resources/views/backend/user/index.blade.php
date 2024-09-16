@extends('backend.layouts.main')

@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Sub Categories</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-category">
                                <i class="fa fa-plus me-2"></i>Add Sub-Category
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <div class="table-resposnive table-div">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->id }}</td>
                                        <td>
                                            <div class="table-imgname">
                                                @if ($subcategory->icon)
                                                    <img src="{{ Storage::url('icon/' . $subcategory->icon) }}"
                                                        class="me-2 preview-img" alt="img">
                                                @else
                                                    No Image
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $subcategory->categoryName->name ?? '' }}</td>
                                        <td>{{ $subcategory->name ?? '' }}</td>
                                        <td>
                                            <div class="active-switch">
                                                <label class="switch">
                                                    <input type="checkbox" class="status-toggle"
                                                        data-id="{{ $subcategory->id }}"
                                                        onclick="return confirm('Are you sure want to change status?')"
                                                        {{ $subcategory->status ? 'checked' : '' }}>
                                                    <span class="sliders round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-actions d-flex justify-content-center">
                                                <button class="btn delete-table me-2"
                                                    onclick="editSubCategory({{ $subcategory->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#edit-category">
                                                    <i class="fe fe-edit"></i>
                                                </button>
                                                <form action="{{ route('subcategories.destroy', $subcategory->id) }}"
                                                    method="POST" style="display:inline;">
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
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
                                    </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
