<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Add New RelatedSite
</button>

<form action="{{route('admin.relatedSite.store')}}" method="post" >
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">create new RelatedSite</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                           placeholder="Enter Related site Name">

                    @error('name')
                   <div class="text-danger">
                       {{$message}}
                   </div>
                    @enderror
                    <br>

                    <input type="text" name="url" class="form-control form-control-user" id="exampleFirstName"
                           placeholder="Enter url">

                    @error('url')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add RelatedSite</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add new category--}}
</form>
