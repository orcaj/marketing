@extends('layouts.master')
@section('title') @lang('translation.Customers') @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') Home @endslot
@slot('title') Notification @endslot
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
         @if(permission('manager'))
         <div>
            <a href="{{route('admin.notification.create')}}" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Create Notification</a>
         </div>
         @endif
         <div class="table-responsive custom-table mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-check table-card-list" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
               <thead>
                  <tr class="bg-transparent">
                     <th>ID</th>
                     @if(permission('manager'))
                     <th style="width: 120px;">Receiver</th>
                     @endif
                     <th>Content</th>
                     <th>Date</th>
                     <th>View</th>
                  </tr>
               </thead>
               <tbody>
                  @if (Auth::user()->role === 'emp')
                  @foreach($notifications as $key => $value)
                  <tr>
                     <td>{{$value->id}} </td>

                     <td>
                        {{$value->content}}
                     </td>
                     <td>{{date('Y-m-d h:i:s', strtotime($value->updated_at))}} </td>
                     {{-- <td>{{date('d M, Y', strtotime($value->updated_at))}} </td> --}}
                     <td>
                        <a class="px-3 text-primary" href="#" data-toggle="modal" data-target="#noti{{$value->id}}"> <i class="uil uil-eye font-size-18"></i></a>
                     </td>

                     <div id="noti{{$value->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title mt-0">Modal Heading</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 {{-- <h5 class="font-size-16">Overflowing text to show scroll behavior</h5> --}}
                                 <p>{{$value->content}}</p>

                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Close</button>
                                 {{-- <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button> --}}
                              </div>
                           </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                     </div><!-- /.modal -->
                  </tr>
                  @endforeach
                  @endif


                  @foreach($admin_notifications as $key => $value)
                  <tr>
                     <td>{{$value->id}} </td>
                     @if(permission('manager'))
                     <td>{{$value->client->name}}</td>
                     @endif
                     <td>
                        {{$value->content}}
                     </td>
                     <td>{{date('Y-m-d h:i:s', strtotime($value->updated_at))}} </td>
                     <td>
                        <a class="px-3 text-primary" href="#" data-toggle="modal" data-target="#noti{{$value->id}}"> <i class="uil uil-eye font-size-18"></i></a>
                     </td>

                     <div id="noti{{$value->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title mt-0">Notification</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 {{-- <h5 class="font-size-16">Overflowing text to show scroll behavior</h5> --}}
                                 <p>{{$value->content}}</p>

                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Close</button>
                                 {{-- <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button> --}}
                              </div>
                           </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                     </div><!-- /.modal -->
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

@endsection
