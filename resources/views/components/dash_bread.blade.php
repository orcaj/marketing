<!-- start page title -->
<form>
   <div class="row">
      <h4 class="mb-0 col-md-2 col-xl-2">{{ $title }}</h4>

   </div>
   <div class="row">
      {{-- <div class="page-title-box d-flex align-items-center justify-content-between "> --}}
      {{-- <h4 class="mb-0 col-md-2 col-xl-2">{{ $title }}</h4> --}}
      @if(permission('manager'))
      <div class="col-md-2 col-xl-2">
         <div class="col-1 text-right">
            <label class="col-form-label">@lang('general.Employee')</label>
         </div>
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

      @if(permission('emp'))
      <div class="col-md-2 col-xl-2">
         <div class="col-1 text-right">
            <label class="col-form-label">@lang('general.Client')</label>
         </div>
         <div class="form-group">
            <select class="form-control required" name="client">
               <option value="">@lang('general.All')</option>
               @foreach(available_client() as $key => $client)
               <option value="{{$client->id}}" {{Request::get('client')==$client->id? 'selected' : ''}}>{{$client->name}}</option>
               @endforeach
            </select>
         </div>
      </div>
      @endif

      <div class="col-md-3 col-xl-3">
         <div class="col-1 text-right">
            <label class="col-form-label">@lang('general.Start Date')</label>
         </div>
         <div class="form-group">
            <input type="date" class="form-control" name="start_date" value="{{Request::get('start_date')}}" />
         </div>
      </div>

      <div class="col-md-3 col-xl-3">
         <div class="col-1 text-right">
            <label class="col-form-label">@lang('general.End Date')</label>
         </div>
         <div class="form-group">
            <input type="date" class="form-control" name="end_date" value="{{Request::get('end_date')}}" />
         </div>
      </div>

      <div class="col-md-2 d-flex mb-3 col-xl-2">
         <button class="btn btn-primary waves-effect waves-light mt-3 mr-2" type="submit" style="margin-top : 35px !important">@lang('general.Filter')</button>
         <a class="btn btn-primary waves-effect waves-light mt-3" href="{{route('index')}}" style="margin-top : 35px !important">@lang('general.reset')</a>
      </div>


      {{-- </form> --}}

      <div class="page-title-right">
         <ol class="breadcrumb m-0">
            {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pagetitle }}</a></li> --}}
            {{-- <li class="breadcrumb-item active">{{ $title }}</li> --}}
         </ol>
      </div>
   </div>
</form>
{{-- </div> --}}
{{-- </div> --}}
<!-- end page title -->
