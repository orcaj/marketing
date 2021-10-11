@extends('layouts.master')
@section('title') Edit Employee @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('pagetitle') Home @endslot
        @slot('title') Edit Employee @endslot
    @endcomponent

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form class="custom-validation" action="{{route('emp.update', $emp->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Name" value="{{$emp->name}}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="User Name" value="{{$emp->username}}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <div>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required
                                            parsley-type="email" placeholder="Enter a valid e-mail"
                                            value="{{$emp->email}}" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Password</label>
                                <div>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="New Password" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Confirm Password</label>
                                <div>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation"  data-parsley-equalto="#password"
                                        placeholder="Re-Type Password" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Clients: </label>
                            </div>
                            
                            @foreach($own_clients as $own_client)
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="client[]" class="custom-control-input" id="check{{$own_client->id}}" value="{{$own_client->id}}" checked>
                                    <label class="custom-control-label" for="check{{$own_client->id}}">{{$own_client->name}}</label>
                                </div>
                            </div>
                            @endforeach

                            @foreach($free_clients as $free_client)
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="client[]" class="custom-control-input" id="check{{$free_client->id}}" value="{{$free_client->id}}" >
                                    <label class="custom-control-label" for="check{{$free_client->id}}">{{$free_client->name}}</label>
                                </div>
                            </div>
                            @endforeach
                          
                        </div>

                        <button class="btn btn-primary mt-2" type="submit">Submit</button>
                        <button class="btn btn-primary mt-2" type="button" id="show-pass">Show Password</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

@endsection
@section('script')
    <!-- parsleyjs -->
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
@endsection
