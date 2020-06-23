@extends('website.layouts.webapp')

@section('title')
    Profile | Food Delivery
@endsection


@section('main_content')
    <section class="section mt-5">
        <div class="section-body container pb-4">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <img alt="image"
{{--                                     @if ($user_details->user_image == 'N/A')--}}
                                src="{{ url('public/website/unnamed.png') }}"
{{--                                @else--}}
{{--                                        src={{ url('public/'.$user_details->user_image) }}--}}
{{--                                @endif --}}
                                    class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name text-center">
                                    <button type="button" class="col-10 m-2 p-2 btn btn-sm btn-outline-primary " data-toggle="modal" data-target="#removeProfilePic">Remove Profile image</button>
                                </div>
                                <div class="author-box-name text-center">
                                    <h3 >
                                        {{ ucfirst(Auth::user()->name) }}
                                    </h3>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="author-box-description">
                                    <p>
                                        @if (!is_null($user_address))
                                            @foreach ($user_address->take(1) as $item)
                                                Address : {{ $item->building }} , {{ $item->street }}
                                            <br>
                                                Landmark : {{ $item->landmark }}
                                                <br>
                                                City : {{ $item->city }} , {{ $item->state }}
                                                <br>
                                                Zip : {{ $item->pincode }}
                                            @endforeach

                                        @else
                                            You dont have any address please add in change profile section.
                                        @endif
                                    </p>
                                </div>


                                <div class="w-100 d-sm-none"></div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                       aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                       aria-selected="false">Change Profile</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                @if (count($errors) > 0)
                                    @if($errors->any())
                                        <div class="alert alert-primary" role="alert">
                                            {{$errors->first()}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @endif
                                @endif
                                <div class="tab-pane fade show active p-3" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                    <div class="row">
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Full Name</strong>
                                            <br>
                                            <p class="text-muted">
                                                {{ ucfirst(Auth::user()->name) }}
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Mobile</strong>
                                            <br>
                                            <p class="text-muted">
                                                {{ Auth::user()->phone }}
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Email</strong>
                                            <br>
                                            <p class="text-muted">
                                                {{ Auth::user()->email }}
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <strong>Wallet Balance</strong>
                                            <br>
                                            <p class="text-muted">{{ Auth::user()->wallet_balance }}</p>
                                        </div>
                                    </div>
                                    {{-- <p class="m-t-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti natus laudantium officiis accusantium delectus vitae dolorum commodi optio, dignissimos repudiandae molestiae soluta ea eligendi quam ad repellat omnis et sequi.</p> --}}


                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="row">
                                                <div class="col-9">
                                                    <label ><strong>All address</strong></label>
                                                </div>
                                                <div class="col-3">
                                                    <a href="#" class="col-11 btn btn-outline-warning text-dark border-0 m-2" data-toggle="modal" data-target="#add_user_address"><i class="fas fa-plus" ></i> Add</a>
                                                </div>
                                            </div>

                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">State</th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">LandMark</th>
                                                    <th scope="col">Zip</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($user_address as $key => $item)
                                                    <tr>

                                                        <th scope="row{{ $key+1 }}" id={{ $key+1 }} >{{ $item->type }}</th>
                                                        <td>{{ $item->building }}</td>
                                                        <td>{{ $item->city }}</td>
                                                        <td>{{ $item->state }}</td>
                                                        <td>{{ $item->country }}</td>
                                                        <td>{{ $item->landmark }}</td>
                                                        <td>{{ $item->pincode }}</td>
                                                        <td><a href="#{{ $item->id }}" class="btn btn-outline-danger border-0"><i class="fa fa-trash"></i> del</a> </td>

                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>


                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                    <form  id="update_current_user" class="needs-validation" url="{{ url('api') }}">
                                        <div class="card-header">
                                            <h4>Edit Profile</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="user_name" value="{{ Auth::user()->name }}">
                                                    <div class="invalid-feedback">
                                                        Please fill in the first name
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Profile Image</label>
                                                    <input type="file" class="form-control"  name="user_image">

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="user_email" value="{{ Auth::user()->email }}">
                                                    <div class="invalid-feedback">
                                                        Please fill in the email
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label>Phone</label>
                                                    <input type="tel" class="form-control" name="user_phone" value="{{ Auth::user()->phone }}">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection