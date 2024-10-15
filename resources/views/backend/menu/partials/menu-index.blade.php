  <table class="table table-striped table-bordered">
      <thead>
          <tr>
              <th>#</th>
              <th>Name</th>
              @can('menus-status')
                  <th>Status</th>
              @endcan
              @can(['menus-edit', 'menus-delete'])
                  <th>Action</th>
              @endcan
          </tr>
      </thead>
      <tbody>
          @forelse ($menusCat as $menu)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                      <div class="table-imgname">
                          @if ($menu->image)
                              <img src="{{ Storage::url('menu/' . $menu->image) }}" class="me-2 preview-img"
                                  alt="img">
                          @else
                              No Image
                          @endif
                          <span>{{ $menu->name }}</span>
                      </div>
                  </td>
                  @can('menus-status')
                      <td>
                          <div class="active-switch">
                              <label class="switch">
                                  <input type="checkbox" class="status-toggle" data-id="{{ $menu->id }}"
                                      {{ $menu->status ? 'checked' : '' }}>
                                  <span class="sliders round"></span>
                              </label>
                          </div>
                      </td>
                  @endcan
                  @can(['menus-edit', 'menus-delete'])
                      <td>
                          <div class="table-actions d-flex justify-content-center">
                              <button class="btn delete-table me-2" onclick="editCategory({{ $menu->id }})"
                                  type="button" data-bs-toggle="modal" data-bs-target="#edit-category">
                                  <i class="fe fe-edit"></i>
                              </button>
                              <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn delete-table" type="submit"
                                      onclick="return confirm('Are you sure want to delete this?')">
                                      <i class="fe fe-trash-2"></i>
                                  </button>
                              </form>
                          </div>
                      </td>
                  @endcan
              </tr>
          @empty
              <tr>
                  <td colspan="4" class="text-center">No data found</td>
              </tr>
          @endforelse
      </tbody>
  </table>
