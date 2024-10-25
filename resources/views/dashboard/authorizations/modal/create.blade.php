<button type="button" class="btn btn-info py-1" data-toggle="modal" data-target="#exampleModal" style="margin-left: 1050px; ">
    Create New Role
</button>

<form action="{{route('admin.authorizations.store')}}" method="post" >
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">create new Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" name="role" class="form-control form-control-range"
                                   id="exampleFirstName"
                                   placeholder="Enter Role Name">
                            @error('role')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        @foreach(config('authorization.permissions') as $key=>$value)
                            <div class="col-sm-4 my-2">

                                {{$value}} <input  value="{{$key}}" type="checkbox" name="permissions[]"   >

                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">create </button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add new category--}}
</form>
