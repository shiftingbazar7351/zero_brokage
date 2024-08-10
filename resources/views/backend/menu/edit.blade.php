<div class="modal fade" id="edit-category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">  
                <h5 class="modal-title">Edit Menu</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x"></i>
                </button>
            </div>
            <div class="modal-body pt-0">
                <form id="editMenuForm" action="{{ route('menus.update',['menu' => $menu->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="editMenuName" name="name" value="{{ old('name',$menu->name)}}">
                    </div>
                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Category</label>
                        <select class="form-control" id="editCategory" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $menu->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger category-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="editSubcategory" class="form-label">Subcategory</label>
                        <select class="form-control" id="editSubcategory" name="subcategory_id">
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $menu->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger subcategory_id-error"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Menu Image</label>
                        <div class="form-uploads">
                            <div class="form-uploads-path">
                                <img id="image-preview-icon" src="{{ asset('admin/assets/img/menu/upload.svg') }}" alt="img" class="default-img">
                                <div class="file-browse">
                                    <h6>Drag & drop image or </h6>
                                    <div class="file-browse-path">
                                        <input type="file" name="image" id="image-input-icon" accept="image/jpeg, image/png">
                                        <a href="javascript:void(0);"> Browse</a>
                                    </div>
                                </div>
                                <h5>Supported formats: JPEG, PNG</h5>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>