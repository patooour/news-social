<form action="{{route('admin.relatedSite.update' , $site->id)}}" method="post">
    @csrf
    @method('PUT')
    <!-- Modal -->
    <div class="modal fade" id="editSite_{{$site->id}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit | site
                        : {{$site->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control form-control-user"
                           id="exampleFirstName"
                           value="{{$site->name}}">
                    @error('name')
                    <strong class="text-danger">
                        {{$message}}
                    </strong>
                    @enderror
                    <br>
                    <input type="text" name="url" class="form-control form-control-user"
                           id="exampleFirstName"
                           value="{{$site->url}}">
                    @error('url')
                    <strong class="text-danger">
                        {{$message}}
                    </strong>
                    @enderror

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update Related site</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add new category--}}
</form>
