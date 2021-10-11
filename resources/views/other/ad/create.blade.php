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
            <form class="custom-validation" action="{{route('ad.store')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="username">User Type</label>
                        <select class="form-control" id="user_type" name="user_type" required>
                           <option value='manager'>Manager</option>
                           <option value='emp'>Employee</option>
                           <option value='client'>Client</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="name">Text</label>
                        <textarea class="form-control" id="msg" name="msg" placeholder="Message" required></textarea>
                     </div>
                  </div>
                  
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
