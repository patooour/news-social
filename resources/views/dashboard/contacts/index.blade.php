@extends('dashboard.common.app')

@section('title')
    Contacts
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contacts information</h6>
            </div>

            {{-- search filter--}}
            @include('dashboard.contacts.filter.search_filter')
            {{-- search filter--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>status</th>
                            <th>Title</th>

                            <th>phone</th>
                           {{-- <th>image</th>--}}
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                       @forelse($contacts as $k => $contact)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$contact->id}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td  style="@if($contact->status == 0) color:red  @else color:green ;font-weight: bold; @endif">{{$contact->status == 0 ? 'unread' : 'Read'}}</td>
                            <td>{{$contact->title }}</td>
                            <td>{{$contact->phone}}</td>
                            {{--<td>
                                <img src="{{asset($contact->image)}}" alt="{{$contact->name}}"
                                     style=" height: 150px; width: 100px;">
                            </td>--}}
                            <td>{{$contact->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="if(confirm('do you want to delete user')) {
                                    document.getElementById('delete_contact_{{$contact->id}}').submit() } return false
                                " class=" btn btn-sm btn-warning"><i class="fa fa-trash"></i></a>
                                <a href="{{route('admin.contacts.show' , $contact->id)}}" class=" btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            </td>

                        </tr>

                        <form id="delete_contact_{{$contact->id}}" action="{{route('admin.contacts.destroy' ,$contact->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                       @empty
                           <tr class="my-1 text-center">
                               <td class="alert alert-info my-1" colspan="8">No contacts !</td>
                           </tr>
                       @endforelse

                        </tbody>

                    </table>
                    {{$contacts->appends(request()->input())->links()}}
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
