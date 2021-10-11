@extends('layouts.master-without-nav')
@section('title') Log @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<style>
   body {
      padding: 40px;
   }

</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') Log @endslot
@slot('title') Log @endslot
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
   <div class="col-lg-12">
      <div>
         <div>
            <a href="{{route('log.clear')}}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus mr-1"></i> Clear All </a>
         </div>

         <div class="table-responsive custom-table mb-4">
            <table class="table table-centered cs-datatable dt-responsive nowrap table-check table-card-list" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
               <thead>
                  <tr class="bg-transparent">
                     <th></th>
                     <th style="width: 120px;">IP Address</th>
                     <th>Mac Address</th>
                     <th>Country</th>
                     <th>Location</th>
                     <th>Time</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($logs as $key => $log)
                  <tr>
                     <td>
                        {{$key+1}}
                     </td>
                     <td>{{$log->ip}}</td>
                     <td>{{$log->mac}}</td>
                     <td>
                        {{$log->country}}
                        <img src="https://www.countryflags.io/{{$log->code}}/flat/64.png" width="30" />
                     </td>
                     <td>{{$log->location}}</td>
                     <td>{{$log->created_at}}</td>
                  </tr>
                  @endforeach

               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- end row -->

@endsection
@section('script')
<!-- Ion Range Slider-->
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<!-- init js -->
<script src="{{ URL::asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>

<script>
   $(document).ready(function() {
      $('.cs-datatable').DataTable({
         //'order': [[1, 'asc']],
          'order': false,
      });
   });

</script>

@endsection
