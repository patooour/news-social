<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    check Token
</button>

<form action="{{route('admin.categories.store')}}" method="post" >
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">create new category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                           placeholder="Enter Category Name">
                    @error('name')
                    <strong class="text-danger">
                        {{$message}}
                    </strong>
                    @enderror
                    <br>
                    <select name="status" id="" class="form-control form-control-file">
                        <option selected disabled value="">status</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                    @error('status')
                    <strong class="text-danger">
                        {{$message}}
                    </strong>
                    @enderror

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add new category--}}
</form>
