@extends('layouts.master')
@section('title') @lang('translation.File_Upload') @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') {{__('Marketing')}} @endslot
@slot('title') {{__('Digital Marketing')}} @endslot
@endcomponent

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <div>
               <form action="{{ route('digital.update', $digital->id)}}" enctype="multipart/form-data" method="post" id="submit_form">
                  @csrf
                  @method('put')
                  <input type="hidden" name="replace" id="replace" value="0" />
                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('File')}}</label>
                           <input type="file" class="form-control" id="file" name="file">
                        </div>
                     </div>

                     <div class="col-md-2">
                        <div class="form-group">
                           {{-- <label for="username">File</label> --}}
                           <p class="mt-4">{{$digital->full_name}}</p>
                        </div>
                     </div>
                     
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('File Name')}}</label>
                           <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$digital->name}}" required>
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Campaign Name')}}</label>
                           <input type="text" class="form-control @error('campaign_name') is-invalid @enderror" id="campaign_name" name="campaign_name" value="{{$digital->campaign_name}}" >
                           @error('campaign_name')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Link Of the Campaign')}}</label>
                           <input type="text" class="form-control @error('campaign_link') is-invalid @enderror" id="campaign_link" name="campaign_link"  value="{{$digital->campaign_link}}" />
                           @error('campaign_link')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Campaign Status')}}</label>
                           <select id="campaign_status" name="campaign_status" class="form-control" required>
                              <option value="processing" {{$digital->campaign_status == 'processing' ? 'selected' : ''}} >Processing</option>
                              <option value="running" {{$digital->campaign_status == 'running' ? 'selected' : ''}} >running</option>
                              <option value="pause" {{$digital->campaign_status == 'pause' ? 'selected' : ''}} >pause</option>
                              <option value="complete" {{$digital->campaign_status == 'complete' ? 'selected' : ''}} >complete</option>
                              <option value="remove" {{$digital->campaign_status == 'remove' ? 'selected' : ''}} >remove</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Clients')}}</label>
                           <select id="client" name="client" class="form-control" required>
                              @foreach($clients as $key => $client)
                              <option value="{{$client->id}}" {{$client->id == $digital->client_id ? 'selected': ''}} >{{$client->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>



                  <button class="btn btn-primary mt-2" type="submit">{{__('Submit')}}</button>
                  <a class="btn btn-primary mt-2" href="{{route('digital.index')}}">{{__('Cancel')}}</a>

               </form>
            </div>

         </div>
      </div>
   </div> <!-- end col -->
</div> <!-- end row -->

<div id="nameConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mt-0" id="myModalLabel">{{__('Warning!')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <h5 class="font-size-16">{{__('File Name Duplicate')}}</h5>
            <p>{{__('Do you want to replace the file?')}}</p>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">{{__('Close')}}</button>
            <button type="button" class="btn btn-primary waves-effect waves-light" id="replaceBtn">{{__('Replace')}}</button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection
@section('script')

<script>
   function check_update_duplicate(name, id) {
      $.ajax({
         url: "{{route('check_update_duplicate')}}"
         , type: 'get'
         , data: {
            name: name
            , type: 'digital'
            , id: id
         }
         , success: function(result) {
            console.log("dd", result)
            if (result == 1) {
               document.getElementById("submit_form").submit();
            } else {
               $("#nameConfirmModal").modal('show');
            }
         }
         , error: function(err) {
            console.log("error", err)
         }
      })
   }


   $("#btnSubmit").click(function(e) {
      e.preventDefault();
      name = $("#name").val();
      id = "{{$digital->id}}";
      check_update_duplicate(name, id);
   })

   $("#replaceBtn").click(function(e) {
      $("#replace").val('1');
      document.getElementById("submit_form").submit();
   })

</script>
<!-- Ion Range Slider-->
{{-- <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script> --}}
@endsection
