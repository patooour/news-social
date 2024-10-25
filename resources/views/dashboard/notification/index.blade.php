@extends('dashboard.common.app')

@section('title')
    Notifications
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}"/>
@endpush


@section('content')

    <section style="">
        <div class="container ">
            <div class="row my-1">
                <div class="col-lg-10">
                    <div class="card mb-4">
                        <div class="card-body ">
                            <h2 class="card-header my-2">
                                Notifications !

                            </h2>
                            @if(auth('admin')->user()->unreadNotifications->count())
                            <a  class="btn btn-danger btn-sm my-2 delete_all_notifications" style="margin-left: 770px">Delete All</a>
                            @endif

                            <div class="alert alert-success  p-3 " id="show_msg" style="display: none">
                                Notification deleted success
                            </div>
                           <div id="show_all_data">
                               @forelse($notifications as $notify)
                                   <div class="alert alert-info  p-3 " id="display_notify_{{$notify->id}}">
                                       <a style="text-decoration: none" class=" d-flex align-items-center"
                                          href="{{$notify->data['link']}}?notify_admin={{$notify->id}}">
                                           <div class="mr-3">
                                               <div class="icon-circle bg-primary">
                                                   <i class="fas fa-file-alt text-white"></i>
                                               </div>
                                           </div>
                                           <div>
                                               <div
                                                   class="small text-danger">{{$notify->created_at->diffForHumans()}}</div>

                                               <span
                                                   class="font-weight ">{{$notify->data['name']}} contact admin message:</span>
                                               <span class="font-weight-bold"> {{$notify->data['body']}} </span>

                                           </div>
                                           <a id="delete_notify_{{$notify->id}}"
                                              class="btn btn-danger btn-sm delete_notify"
                                              delete_notification="{{$notify->id}}"
                                              style="margin-left: 780px">Delete</a>
                                       </a>
                                   </div>
                               @empty
                                   <div class="alert alert-warning p-3">
                                       <a class="dropdown-item d-flex align-items-center"
                                          href="#">
                                           <div class="mr-3">
                                               <div class="icon-circle bg-primary">
                                                   <i class="fas fa-file-alt text-white"></i>
                                               </div>
                                           </div>
                                           <div>

                                               <span class="font-weight-bold">No Notifications !</span>
                                           </div>
                                       </a>
                                   </div>
                               @endforelse
                           </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>




    </section>
@endsection


@push('js')
    <script>
        $(document).on('click' , '.delete_notify' ,function (e){
           e.preventDefault();

           var notifyID = $(this).attr('delete_notification');

           $.ajax({
               type:"GET",
               url:"{{route('admin.notifications.destroy',':notifyID')}}".replace(':notifyID',notifyID),
               success:function (data){
                $("#display_notify_" + notifyID).hide();
                $("#show_msg").show();

               },
               error:function (data){

               },
           })
        });
        $(document).on('click', '.delete_all_notifications', function (e) {
            e.preventDefault();

            $.ajax({
                type: "GET",
                url: "{{ route('admin.notifications.delete.all') }}",
                success: function (data) {
                    $("#show_all_data").hide();
                    $("#show_msg").text(`${data.message}`).show();
                },
                error: function (data) {

                }
            });
        });

    </script>

@endpush
