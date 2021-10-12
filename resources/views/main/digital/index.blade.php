@extends('layouts.master')
@section('title') @lang('translation.Customers') @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') {{__('Marketing')}} @endslot
@slot('title') {{__('Digital Marketing')}} @endslot
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
      <form>
         <div class="row">
            <div class="{{auth()->user()->role == 'emp' ? 'col-8' : 'col-5'}}">
               <a href="{{route('digital.create')}}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus mr-1"></i> @lang('general.Add')</a>
            </div>
            <div class="col-1 text-right">
               <label class="col-form-label">@lang('general.Client')</label>
            </div>
            <div class="col-2">
               <div class="form-group">
                  <select class="form-control required" name="client">
                     <option value="">@lang('general.All')</option>
                     @foreach(available_client() as $key => $client)
                        <option value="{{$client->id}}" {{Request::get('client')==$client->id? 'selected' : ''}}>{{$client->name}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            @if(auth()->user()->role != 'emp')
            <div class="col-1 text-right">
               <label class="col-form-label">@lang('general.Employee')</label>
            </div>
            <div class="col-2">
               <div class="form-group">
                  <select class="form-control required" name="emp">
                     <option value="">@lang('general.All')</option>
                     @foreach(activeEmps() as $key => $emp)
                        <option value="{{$emp->id}}" {{Request::get('emp')==$emp->id? 'selected' : ''}}>{{$emp->name}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            @endif
            <div class="col-1">
               <button class="btn btn-primary waves-effect waves-light" type="submit">@lang('general.Filter')</button>
            </div>
         </div>
      </form>


      <div class="table-responsive custom-table mb-4">
         <table class="table table-centered datatable dt-responsive nowrap table-check table-card-list" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
               <tr class="bg-transparent">
                  {{-- <th style="width: 20px;">
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="checkAll">
                        <label class="custom-control-label" for="checkAll"></label>
                     </div>
                  </th> --}}
                  <th>@lang('general.No')</th>
                  <th style="width: 120px;">@lang('general.Campaign Name')</th>
                  <th style="width: 120px;">@lang('general.Campaign Status')</th>
                  <th style="width: 120px;">@lang('general.File Name')</th>
                  <th style="width: 120px;">@lang('general.Client')</th>
                  @if(permission('manager'))
                  <th style="width: 120px;">@lang('general.Employee')</th>
                  @endif
                  <th>@lang('general.Date added')</th>
                  <th style="width: 120px;">@lang('general.File to Download')</th>
                  <th style="width: 120px;">@lang('general.Action')</th>
               </tr>
            </thead>
            <tbody>
               @foreach($digitals as $key => $digital)
               <tr id="row-{{$digital->id}}">
                  {{-- <td>
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check-{{$digital->id}}">
                        <label class="custom-control-label" for="check-{{$digital->id}}"></label>
                     </div>
                  </td> --}}
                  <td>{{$key+1}}</td>
                  <td>{{$digital->campaign_name}}</td>
                  <td>{{$digital->campaign_status}}</td>
                  <td>
                     {{-- <img src="{{ asset('public/upload/digital/'.$digital->name) }}" alt="{{$digital->name}}" loading="lazy"
                     class="avatar-xs rounded-circle mr-2"> --}}
                     <span>{{$digital->full_name}}</span>
                  </td>
                  <td> {{$digital->getClient->name}} </td>
                  @if(permission('manager'))
                  <td> {{getEmpName($digital->getClient->id)}} </td>
                  @endif
                  <td>
                     <p class="mb-1">{{$digital->created_at}}</p>
                  </td>

                  <td>
                     @if($digital->type != " ")
                     <a class="btn btn-primary waves-effect waves-light" href="{{ asset('public/upload/digital/'.$digital->full_name) }}" download>@lang('general.Download') </a>
                     @endif
                  </td>

                  <td>
                     <a href="{{route('digital.edit', $digital->id)}}" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>
                     <a href="javascript:void(0);" class="px-3 text-primary delete-btn" data-toggle="tooltip" data-id="{{$digital->id}}" data-placement="top" title="Delete"><i class="uil uil-trash font-size-18"></i></a>
                     @if($digital->type != " ")
                     <a class="px-3 text-primary" href="{{ asset('public/upload/digital/'.$digital->full_name) }}" target="_blank"> <i class="uil uil-eye font-size-18"></i></a>
                     @endif
                     @if($digital->campaign_link)
                     <a class="px-3 text-primary connect-link" href="{{$digital->campaign_link}}" target="_blank"> <i class="uil uil-link font-size-18"></i></a>
                     @endif
                  </td>
               </tr>
               @endforeach

            </tbody>
         </table>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-title-header">
         </div>
         <div class="card-body">
         @include('layouts.calculation')
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
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>

{{-- calc js --}}
<script src="{{ URL::asset('/assets/js/calcData.js') }}"></script>
<script src="{{ URL::asset('/assets/js/calc.js') }}"></script>

<script>

$(document).ready(function () {
    $('.datatable').DataTable({
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false
         }],
        // 'order': [[1, 'asc']],
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
   $(document).on('click', '.connect-link', function(e){
      e.preventDefault();
      link=$(this).attr('href');
      if(link.slice(0, 3) == 'www' ){
         link="https://"+link;
      }
      window.open(link, '_blank');
   } )

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
               url: "{{route('digital.delete')}}", 
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
