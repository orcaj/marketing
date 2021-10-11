@extends('layouts.master')
@section('title') Change Password @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('pagetitle') Home @endslot
        @slot('title') Change Password @endslot
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
                    <form class="custom-validation" action="{{route('reset-password')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="current_password">Current Password</label>
                                <div>
                                    <input type="password" id="current_password" name="current_password" class="form-control pass" required
                                        placeholder="Current Password" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>New Password</label>
                                <div>
                                    <input type="password" id="password" name="password" class="form-control pass" required
                                        placeholder="New Password"  minlength="6"/>
                                    @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Confirm Password</label>
                                <div>
                                    <input type="password" class="form-control pass" id="password_confirmation"
                                        name="password_confirmation" required data-parsley-equalto="#password"
                                        placeholder="Re-Type Password"   minlength="6"  />
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Submit form</button>
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
