<div class="card-body">
    <form action="{{  route('admin.categories.index')  }}" method="get" >
        @csrf
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="sort_by" id="">
                        <option selected disabled value="">Sort by</option>
                        <option value="id">id</option>
                        <option value="name">name</option>
                        <option value="created_at">created At</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="order_by" id="">
                        <option selected disabled value="">Order by</option>
                        <option value="DESC">Descending</option>
                        <option value="ASC">Ascending</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="limit_by" id="">
                        <option selected disabled value="">Limit</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="status" id="">
                        <option selected disabled value="">status</option>
                        <option value="active">Active</option>
                        <option value="not_active">not Active</option>
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="search for ...." name="search">
                </div>
            </div>

            <div class="col-1">
                <div class="form-group">
                    <button class="form-control btn btn-sm btn-info" >
                        Search
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
