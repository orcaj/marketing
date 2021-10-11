@extends('layouts.master')
@section('title') @lang('translation.Customers') @endsection
@section('css')
<!-- ION Slider -->
<link href="{{ URL::asset('/assets/libs/ion-rangeslider/ion-rangeslider.min.css') }}" rel="stylesheet" type="text/css" />
<style>
   .product-img img {
      height: 300px;
   }

</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('pagetitle') {{__('Marketing')}} @endslot
@slot('title') {{__('ADDITIONAL REPORT')}} @endslot
@endcomponent

<div class="alert alert-success alert-dismissible fade show d-none" role="alert">
   {{__('Request Sent!')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>

<div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
   {{__('Error')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>

<div class="row">
   <div class="col-xl-12 col-lg-12">
      <div class="card">
         <div class="card-title-header">
         </div>
         <div class="card-body">

            <div class="row">
               <div class="col-md-6">
               </div>
               <div class="col-md-6">
                  <div class="form-inline float-md-right">
                     <div class="search-box ml-2">
                        <div class="position-relative">
                           <form method="get">
                              <input type="text" name="keyword" class="form-control bg-light border-light rounded" placeholder="Search..." value="{{Request::get('keyword')}}">
                              <i class="mdi mdi-magnify search-icon"></i>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <ul class="nav nav-tabs nav-tabs-custom mt-3 mb-2 ecommerce-sortby-list">
               <li class="nav-item">
                  <a class="nav-link disabled font-weight-medium" href="#" tabindex="-1" aria-disabled="true">{{__('Sort by:')}}</a>
               </li>
               <li class="nav-item">
                  <form>
                     <input type="hidden" name="sort" value="newest" />
                     <button class="nav-link {{Request::get('sort') != 'oldest'? 'active' : ''}}" type="submit">{{__('Newest')}}</button>
                  </form>
               </li>
               <li class="nav-item">
                  <form>
                     <input type="hidden" name="sort" value="oldest" />
                     <button class="nav-link  {{Request::get('sort') == 'oldest'? 'active' : ''}}" type="submit">{{__('Oldest')}}</button>
                  </form>
               </li>
            </ul>
            <div class="row Allproduct">
               @foreach($digitals as $key => $digital)
               <div class='col-xl-4 col-sm-6'>
                  <div class='product-box' id="{{$digital->id}}">
                     <div class='product-img pt-4 px-4'>
                        <div class='product-ribbon badge badge-primary'>{{__('New')}}</div>
                        <div class='product-wishlist'>
                        </div>
                        <a href="javascript:void(0)">
                           @if($digital->type == 'image')
                           <img src="{{asset('public/upload/report/'.$digital->full_name)}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('public/upload/report/'.$digital->full_name)}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @elseif($digital->type == 'video')
                            <img src="{{asset('assets/logo/video.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/video.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @elseif($digital->type == 'text')
                           @if($digital->ext == 'txt')
                           <img src="{{asset('assets/logo/text.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/text.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @elseif($digital->ext == 'html')
                           <img src="{{asset('assets/logo/html.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/html.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @else
                           <img src="{{asset('assets/logo/file.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/file.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @endif
                           @elseif($digital->type == 'application')
                           @if($digital->ext == 'pdf')
                           <img src="{{asset('assets/logo/pdf.jpg')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/pdf.jpg')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @elseif($digital->ext == 'xlsx' || $digital->ext == 'xls')
                           <img src="{{asset('assets/logo/excel.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/excel.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @elseif($digital->ext == 'pptx' || $digital->ext == 'ppt')
                           <img src="{{asset('assets/logo/ppt.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/ppt.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @else
                           <img src="{{asset('assets/logo/file.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/file.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @endif
                           @else
                           <img src="{{asset('assets/logo/file.png')}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('assets/logo/file.png')}}" alt='' class='img-fluid mx-auto p-h-img'>
                           @endif
                        </a>
                        <ul class='list-unstyled mb-0 text-muted product-color'>
                           <li class='text-center'>
                              <a href="{{ asset('public/upload/report/'.$digital->full_name) }}" target='_blank' class='btn btn-primary'><i class='uil uil-eye font-size-18'></i></a>
                           </li>
                           <li class='text-center'>
                              <a href="{{ asset('public/upload/report/'.$digital->full_name)}}" target='_blank' class='btn btn-primary' download><i class='uil-arrow-circle-down font-size-18'></i></a>
                           </li>
                           <li>
                        </ul>
                     </div>
                     <div class='page-content p-4'>
                        <h5 class='mb-1'><a href='#' class='text-dark'>{{$digital->full_name}}</a></h5>
                        <p class='text-muted font-size-15 mb-0'>{{$digital->updated_at}}</p>
                        <p class='text-muted font-size-15'>{{$digital->type}}</p>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>

            <div class="row mt-4">
               {{$digitals->links('layouts.pagenation')}}
            </div>
            <!-- end row -->
         </div>
      </div>
   </div>
</div>
<!-- end row -->

@endsection
@section('script')
<!-- Ion Range Slider-->
<script src="{{ URL::asset('/assets/libs/ion-rangeslider/ion-rangeSlider.min.js') }}"></script>
<!-- init js -->
<script src="{{ URL::asset('/assets/js/pages/product-filter-range.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/calcData.js') }}"></script>

<script src="{{ URL::asset('/assets/js/calc.js') }}"></script>


@endsection
