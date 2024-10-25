@extends('fronted.common.app')


@section('title')
Contact
@endsection

@section('breadCrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{route('fronted.index')}}">Home</a></li>

    <li class="breadcrumb-item">Contact US</li>

@endsection

@section('content')




    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="contact-form">
                       @include('fronted.common.errors')
                        <form method="post" action="{{route('fronted.contactUs.store')}}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Your Name"
                                        name="name"
                                    />
                                </div>
                                <div class="form-group col-md-4">
                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="Your Email"
                                        name="email"
                                    />
                                </div>
                                <div class="form-group col-md-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Your phone"
                                        name="phone"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Subject"
                                    name="title"
                                />
                            </div>
                            <div class="form-group">
                  <textarea
                      class="form-control"
                      rows="5"
                      placeholder="Message"
                      name="body"
                  ></textarea>
                            </div>
                            <div>
                                <button class="btn" type="submit" id="sendMsg">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p class="mb-4">
                            The contact form is currently inactive. Get a functional and
                            working contact form with Ajax & PHP in a few minutes. Just copy
                            and paste the files, add a little code and you're done.

                        </p>
                        <h4><i class="fa fa-map-marker"></i>{{$settings->street}},{{$settings->city}},{{$settings->country}}</h4>
                        <h4><i class="fa fa-envelope"></i>{{$settings->email}}</h4>
                        <h4><i class="fa fa-phone"></i>{{$settings->phone}}</h4>
                        <div class="social">
                            <a href="{{$settings->twitter}}"><i class="fab fa-twitter"></i></a>
                            <a href="{{$settings->facebook}}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{$settings->instagram}}"><i class="fab fa-instagram"></i></a>
                            <a href="{{$settings->youtube}}"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection

{{--

@push('script')
    <script>
        $(document).on('submit','#sendMsg',function(e){
            e.preventDefault();


        });
    </script>

@endpush
--}}
