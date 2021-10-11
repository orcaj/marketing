@extends('layouts.master')
@section('title') Create Client @endsection
@section('css')
<!-- Plugins css -->
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') Home @endslot
@slot('title') Create Client @endslot
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
            <form class="custom-validation" action="{{route('admin.notification.store')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="name">Text</label>
                        <textarea class="form-control" id="msg" name="msg" placeholder="Message" required></textarea>
                     </div>
                  </div>
               </div>

               <hr />

               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="name">User Type</label>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="emps" name="user_type[]" value="emp">
                           <label class="custom-control-label" for="emps">Employees</label>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="clients" name="user_type[]" value="client">
                           <label class="custom-control-label" for="clients">Clients</label>
                        </div>
                     </div>
                  </div>
               </div>

               <hr />

               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="name">Users</label>
                     </div>
                  </div>
                  @foreach ($users as $user)
                  <div class="col-md-4">
                     <div class="form-group">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="user{{$user->id}}" name="user[]" value="{{$user->id}}">
                           <label class="custom-control-label" for="user{{$user->id}}">{{$user->name}}</label>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>

               <button class="btn btn-primary mt-2" type="submit">Submit</button>
            </form>
         </div>
      </div>
      <!-- end card -->
   </div> <!-- end col -->

</div>


@endsection
@section('script')
<!-- parsleyjs -->
<script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<!-- init js -->
<script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection
