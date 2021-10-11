@extends('layouts.master')
@section('title') @lang('translation.File_Upload') @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') {{__('Marketing')}} @endslot
@slot('title') {{__('Invoice')}} @endslot
@endcomponent

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <div>
               <form action="{{ route('invoice.update', $invoice) }}" enctype="multipart/form-data" method="post" id="submit_form">
                  @csrf
                  @method('put')
                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('File')}}</label>
                           <input type="file" class="form-control" id="file" name="file" >
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Invoice Id')}}</label>
                           <input type="text" class="form-control @error('name') is-invalid @enderror" id="invoice_id" name="invoice_id" value="{{$invoice->invoice_id}}" required>
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Billing Name')}}</label>
                           <input type="text" class="form-control @error('name') is-invalid @enderror" id="billing_name" name="billing_name" value="{{$invoice->billing_name}}"  required>
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Amount')}}</label>
                           <input type="number" class="form-control @error('name') is-invalid @enderror" id="amount" name="amount" value="{{$invoice->amount}}"  required>
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="status1">{{__('Status')}}</label>
                           <select id="status1" name="status" class="form-control" required>
                              @foreach(['Paid', 'pending', 'not paid'] as $key => $status)
                              <option value="{{$status}}" {{$invoice->status==$status ? 'selected' : ''}} >{{$status}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>


                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="username">{{__('Clients')}}</label>
                           <select id="client" name="client" class="form-control" required>
                              @foreach($clients as $key => $client)
                              <option value="{{$client->id}}" {{$invoice->client_id==$client->id ? 'selected' : ''}} >{{$client->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                  </div>


                  <button class="btn btn-primary mt-2" id="btnSubmit" type="submit">{{__('Submit')}}</button>
                  <a class="btn btn-primary mt-2" href="{{route('invoice.index')}}">{{__('Cancel')}}</a>

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
            , type: 'invoice'
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




</script>
<!-- Ion Range Slider-->
{{-- <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script> --}}
@endsection
