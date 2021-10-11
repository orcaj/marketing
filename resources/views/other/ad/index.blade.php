@extends('layouts.master')
@section('title') @lang('translation.Customers') @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') Home @endslot
@slot('title') Ad @endslot
@endcomponent

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
   {{session('success')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{session('error')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>
@endif

<div class="row">
   <div class="col-lg-12">
      <div>
         <div>
            <a href="{{route('ad.create')}}" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Ad</a>
         </div>
         <div class="table-responsive custom-table mb-4">
            <table class="table table-centered datatable-ad dt-responsive nowrap table-check table-card-list" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
               <thead>
                  <tr class="bg-transparent">
                     <th>ID</th>
                     <th style="width: 120px;">Receiver</th>
                     <th>Content</th>
                     <th>Date</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($ads as $key => $value)
                  <tr>
                     <td>{{$key+1}} </td>
                     <td>{{$value->user_type}} </td>
                     <td>
                        {{$value->msg}}
                     </td>
                     <td>{{date('d M, Y', strtotime($value->created_at))}} </td>
                     <td>
                        <a href="{{route('ad.edit', $value->id)}}" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>
                        <a href="javascript:void(0);" class="px-3 text-primary delete-btn" data-id="{{$value->id}}"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="uil uil-trash font-size-18"></i></a>

                     </td>
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

$(document).ready(function () {
    $('.datatable-ad').DataTable({
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false
         }],
         'order': false,
         "language": {
            "paginate": {
                "previous": "<i class='mdi mdi-chevron-left'>",
                "next": "<i class='mdi mdi-chevron-right'>"
            }
        },
        "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        }

    });
});

</script>
<script>
   $('.delete-btn').click(function() {
      id = $(this).data('id')
      Swal.fire({
         title: "{{__('general.Are you sure?')}}"
         //, text: "{{__('general.You wont be able to revert this!')}}"
         , icon: "warning"
         , showCancelButton: true
         , confirmButtonColor: "#2a4fd7"
         , cancelButtonColor: "#2a4fd7"
         , confirmButtonText: "{{__('general.Yes, delete it!')}}"
      }).then(function(result) {
         if (result.value) {
            $.ajax({
               url: "{{route('ad.delete')}}", 
               type: 'delete', 
               data: {
                  _token: "{{csrf_token()}}", 
                  id: id
               }, 
               success: function(res) {
                  console.log('data', res)
                  if (res) {
                     //$("#row-"+id).remove();
                     Swal.fire("{{__('Deleted!')}}", "{{__('Your file has been deleted.')}}", "success");
                     location.reload();
                  }
               }, 
               error: function(e) {
                  console.log('error')
               }
            })
         }
      });
   });

</script>

@endsection
