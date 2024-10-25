<form action="{{route('admin.categories.update' , $category->id)}}" method="post">
    @csrf
    @method('PUT')
    <!-- Modal -->
    <div class="modal fade" id="editCategory_{{$category->id}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit | Category
                        : {{$category->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control form-control-user"
                           id="exampleFirstName"
                           value="{{$category->name}}">
                    @error('name')
                    <strong class="text-danger">
                        {{$message}}
                    </strong>
                    @enderror
                    <br>
                    <select name="status" id="" class="form-control form-control-file">
                        <option disabled value="">status</option>
                        <option @selected($category->status == 1) value="1">Active</option>
                        <option @selected($category->status == 0) value="0">Not Active
                        </option>
                    </select>
                    @error('status')
                    <strong class="text-danger">
                        {{$message}}
                    </strong>
                    @enderror

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add new category--}}
</form>
