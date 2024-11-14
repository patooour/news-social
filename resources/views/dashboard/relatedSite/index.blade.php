@extends('dashboard.common.app')

@section('title')
    RelatedSite
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

      {{--  <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">RelatedSite</h1>--}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">RelatedSite information</h6>
            </div>

           <div class="card-body " style="margin-left: 1020px">
               <!-- Button trigger modal -->
               @include('dashboard.relatedSite.create')

           </div>
            {{-- search filter--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>name</th>
                            <th>url</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                       @forelse($related_site as $k => $site)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$site->id}}</td>
                            <td>{{$site->name}}</td>
                            <td>
                                <a href="{{$site->url}}">
                                    {{substr($site->url , 0 , 50)}}
                                </a>
                            </td>
                            <td>{{$site->created_at->format('d-m-y')}}</td>
                            <td class="text-center ">
                                <a href="javascript:void(0)" onclick="if(confirm('do you want to delete post')) {
                                    document.getElementById('delete_relatedSite_{{$site->id}}').submit() } return false
                                " class="btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>


                                <a data-toggle="modal" data-target="#editSite_{{$site->id}}"
                                   href="{{route('admin.relatedSite.show' , $site->id)}}"
                                   class=" btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            </td>

                        </tr>

                        <form id="delete_relatedSite_{{$site->id}}" action="{{route('admin.relatedSite.destroy' ,$site->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>

                        {{--start edit modal --}}
                        @include('dashboard.relatedSite.edit')
                       @empty
                           <tr class="my-1 text-center">
                               <td class="alert alert-info my-1" colspan="8">No Posts !</td>
                           </tr>
                       @endforelse

                        </tbody>

                    </table>
                    {{$related_site->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection


@push('js')
    <script>

    </script>

@endpush
