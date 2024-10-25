@extends('dashboard.common.app')

@section('title')
    Settings
@endsection

@push('css')
    <link rel="canonical" href="{{url()->full()}}" />
    <!-- dropify plugin -->
    <link href="{{ asset('assets/vendor/dropify/dist/css/dropify.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/dropify/dist/css/demo.css') }}" rel="stylesheet">

    <!--end dropify plugin -->
@endpush


@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->


        <div class="row justify-content-center d-flex" >

            <div class="col-10 ">

                <div class="card-body shadow mb-2 " >
                    <h1 class="h3 mb-2 text-gray-800 ">Update Settings</h1>
                    <form action="{{route('admin.settings.update')}}"  class="user" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" value="{{$settings->id}}" name="setting_id">
                        <div class="form-group row">
                            <div class="col-sm-6 ">
                                <label class="form-check-label">enter site name: </label>
                                <input type="text" name="site_name" class="form-control form-control-user" id="exampleFirstName"
                                       placeholder="enter site name" value="{{$settings->site_name}}">
                                @error('site_name')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check-label">enter email: </label>
                                <input type="email"  name="email" class="form-control form-control-user" id="exampleLastName"
                                       value="{{$settings->email}}"     placeholder="enter email" >
                                @error('email')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-6 ">
                                <label class="form-check-label">Enter facebook: </label>
                                <input type="text" name="facebook" class="form-control form-control-user" id="exampleFirstName"
                                       value="{{$settings->facebook}}"  placeholder="facebook">
                                @error('facebook')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check-label">Enter youtube: </label>
                                <input type="text" name="youtube" class="form-control form-control-user" id="exampleLastName"
                                       value="{{$settings->youtube}}"    placeholder="youtube">
                                @error('youtube')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="form-check-label">Enter instagram: </label>
                                <input type="text" name="instagram" class="form-control form-control-user" id="exampleFirstName"
                                       value="{{$settings->instagram}}"      placeholder="instagram">
                                @error('instagram')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check-label">Enter twitter: </label>
                                <input type="text" name="twitter" class="form-control form-control-user"
                                       value="{{$settings->twitter}}"       placeholder="twitter">
                                @error('twitter')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-3 mb-3 mb-sm-0">
                                <label class="form-check-label">Enter country: </label>
                                <input type="text" name="country" class="form-control form-control-user" id="exampleFirstName"
                                       value="{{$settings->country}}"      placeholder="country">
                                @error('country')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-check-label">Enter city: </label>
                                <input type="text" name="city" class="form-control form-control-user"
                                       value="{{$settings->city}}"      placeholder="city">
                                @error('city')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                            <div class="col-3 ">
                                <label class="form-check-label">Enter street: </label>
                                <input type="text" name="street" class="form-control form-control-user"
                                       value="{{$settings->street}}"      placeholder="street">
                                @error('street')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-check-label">Enter phone: </label>
                                <input type="text" name="phone" class="form-control form-control-user" id="exampleFirstName"
                                       value="{{$settings->phone}}"   placeholder="phone">
                                @error('phone')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-12">
                                <label class="form-check-label">Enter small desc: </label>
                                <textarea name="small_desc" class="form-control form-control-user"
                                        placeholder="small desc">{{$settings->small_desc}}</textarea>
                                @error('small_desc')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="form-check-label">Enter logo: </label>
                                <input type="file" name="logo" class="form-control form-control-range dropify"
                                       id="dropify_logo"
                                       placeholder="enter logo">
                                @error('logo')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                                <img src="{{asset($settings->logo)}}" class="img-thumbnail" alt="{{$settings->name}}">

                            </div>
                            <div class="col-sm-6">
                                <label class="form-check-label">Enter favicon: </label>
                                <input type="file" name="favicon" class="form-control form-control-range dropify"

                                       placeholder="favicon">
                                @error('favicon')
                                <strong class="text-danger">
                                    {{$message}}
                                </strong>
                                @enderror
                                <img src="{{asset($settings->favicon)}}" class="img-thumbnail" alt="{{$settings->name}}">
                            </div>
                        </div>
                        <br>
                        <button type="submit" style="font-size: large;font-family: 'Blabeloo  MagdySoliman'"
                                class="btn btn-primary btn-user btn-block">
                            Update Settings
                        </button>


                    </form>

                </div>

            </div>
        </div>

    </div>


@endsection


@push('js')
    <!-- dropify plugin -->
    <script src="{{ asset('assets/vendor/dropify/dist/js/dropify.js') }}"></script>
    <!-- end sdropify plugin -->
    <script>

        $('.dropify').dropify({
            messages: {
                'default': 'upload image',
                'replace': 'upload image',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
            }

        );


    </script>

@endpush
