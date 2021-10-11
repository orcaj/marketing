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
@slot('title') {{__('Digital')}} @endslot
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
   {{-- <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0">Filters</h5>
                </div>

                <div class="p-4">
                    <h5 class="font-size-14 mb-3">Categories</h5>
                    <div class="custom-accordion">
                        <a class="text-body font-weight-semibold pb-2 d-block" data-toggle="collapse"
                            href="#headphones-collapse" role="button" aria-expanded="false"
                            aria-controls="headphones-collapse">
                            <i class="mdi mdi-chevron-up accor-down-icon text-primary mr-1"></i> Headphones
                        </a>
                        <div class="collapse show" id="headphones-collapse">
                            <div class="card p-2 border shadow-none">
                                <ul class="list-unstyled categories-list mb-0">
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Audio-Technica</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Sennheiser</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Sony</a></li>
                                    <li class="active"><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Boot</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> JBL</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="custom-accordion">
                        <a class="text-body font-weight-semibold pb-2 d-block collapsed" data-toggle="collapse"
                            href="#phones-collapse" role="button" aria-expanded="false" aria-controls="phones-collapse">
                            <i class="mdi mdi-chevron-up accor-down-icon text-primary mr-1"></i> Phones
                        </a>
                        <div class="collapse" id="phones-collapse">
                            <div class="card p-2 border shadow-none">
                                <ul class="list-unstyled categories-list mb-0">
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> iPhone</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Samsung</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Sony</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Xolo</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="custom-accordion">
                        <a class="text-body font-weight-semibold pb-2 d-block collapsed" data-toggle="collapse"
                            href="#accessories-collapse" role="button" aria-expanded="false"
                            aria-controls="accessories-collapse">
                            <i class="mdi mdi-chevron-up accor-down-icon text-primary mr-1"></i> Accessories
                        </a>
                        <div class="collapse" id="accessories-collapse">
                            <div class="card p-2 border shadow-none">
                                <ul class="list-unstyled categories-list mb-0">
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Earphone</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Mobile Cover</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Charger</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium mr-1"></i> Battery</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 border-top">
                    <div>
                        <h5 class="font-size-14 mb-4">Price</h5>

                        <input type="text" id="pricerange">
                    </div>
                </div>

                <div class="custom-accordion">
                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filtersizes-collapse" class="text-dark d-block"
                                    data-toggle="collapse">Items <i
                                        class="mdi mdi-chevron-up float-right accor-down-icon"></i></a></h5>

                            <div class="collapse show" id="filtersizes-collapse">
                                <div class="mt-4">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <h5 class="font-size-15 mb-0">Select items</h5>
                                        </div>
                                        <div class="w-xs">
                                            <select class="custom-select">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3" selected>3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filterprodductcolor-collapse" class="text-dark d-block"
                                    data-toggle="collapse">Colors <i
                                        class="mdi mdi-chevron-up float-right accor-down-icon"></i></a></h5>

                            <div class="collapse show" id="filterprodductcolor-collapse">
                                <div class="mt-4">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck1">
                                        <label class="custom-control-label" for="productcolorCheck1"><i
                                                class="mdi mdi-circle text-dark mx-1"></i> Black</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck2">
                                        <label class="custom-control-label" for="productcolorCheck2"><i
                                                class="mdi mdi-circle text-light mx-1"></i> White</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck3">
                                        <label class="custom-control-label" for="productcolorCheck3"><i
                                                class="mdi mdi-circle text-secondary mx-1"></i> Gray</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck4">
                                        <label class="custom-control-label" for="productcolorCheck4"><i
                                                class="mdi mdi-circle text-primary mx-1"></i> Blue</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck5">
                                        <label class="custom-control-label" for="productcolorCheck5"><i
                                                class="mdi mdi-circle text-success mx-1"></i> green</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck6">
                                        <label class="custom-control-label" for="productcolorCheck6"><i
                                                class="mdi mdi-circle text-danger mx-1"></i> Red</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck7">
                                        <label class="custom-control-label" for="productcolorCheck7"><i
                                                class="mdi mdi-circle text-warning mx-1"></i> Yellow</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="productcolorCheck8">
                                        <label class="custom-control-label" for="productcolorCheck8"><i
                                                class="mdi mdi-circle text-purple mx-1"></i> Purple</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filterproduct-discount-collapse"
                                    class="text-dark d-block" data-toggle="collapse">Discount <i
                                        class="mdi mdi-chevron-up float-right accor-down-icon"></i></a></h5>

                            <div class="collapse show" id="filterproduct-discount-collapse">
                                <div class="mt-4">
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productdiscountRadio1" name="productdiscountRadio"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productdiscountRadio1">50% or more</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productdiscountRadio2" name="productdiscountRadio"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productdiscountRadio2">40% or more</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productdiscountRadio3" name="productdiscountRadio"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productdiscountRadio3">30% or more</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productdiscountRadio4" name="productdiscountRadio"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productdiscountRadio4">20% or more</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productdiscountRadio5" name="productdiscountRadio"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productdiscountRadio5">10% or more</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productdiscountRadio6" name="productdiscountRadio"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productdiscountRadio6">Less than
                                            10%</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filterproduct-color-collapse"
                                    class="collapsed text-dark d-block" data-toggle="collapse">Customer Rating <i
                                        class="mdi mdi-chevron-up float-right accor-down-icon"></i></a></h5>

                            <div class="collapse" id="filterproduct-color-collapse">
                                <div class="mt-4">
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productratingRadio1" name="productratingRadio1"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productratingRadio1">4 <i
                                                class="mdi mdi-star text-warning"></i> & Above</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productratingRadio2" name="productratingRadio1"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productratingRadio2">3 <i
                                                class="mdi mdi-star text-warning"></i> & Above</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productratingRadio3" name="productratingRadio1"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productratingRadio3">2 <i
                                                class="mdi mdi-star text-warning"></i> & Above</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" id="productratingRadio4" name="productratingRadio1"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="productratingRadio4">1 <i
                                                class="mdi mdi-star text-warning"></i></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div> --}}

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
                           <img src="{{asset('public/upload/digital/'.$digital->full_name)}}" alt='' class='img-fluid mx-auto p-img'>
                           <img src="{{asset('public/upload/digital/'.$digital->full_name)}}" alt='' class='img-fluid mx-auto p-h-img'>
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
                              <a href="{{ asset('public/upload/digital/'.$digital->full_name) }}" target='_blank' class='btn btn-primary'><i class='uil uil-eye font-size-18'></i></a>
                           </li>
                           <li class='text-center'>
                              <a href="{{ asset('public/upload/digital/'.$digital->full_name)}}" target='_blank' class='btn btn-primary' download><i class='uil-arrow-circle-down font-size-18'></i></a>
                           </li>
                           <li>
                        </ul>
                     </div>
                     <div class='page-content p-4'>
                        <h5 class='mb-1'><a href='#' class='text-dark'>{{$digital->full_name}}</a></h5>
                        <p class='text-muted font-size-15'>{{$digital->updated_at}}</p>
                        </h5>
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

      <!-- <div class="card">
         <div class="card-title-header">
         </div>
         <div class="card-body">
            @include('layouts.calculation')
         </div>
      </div> -->

      <div class="card">

         <div class="card-body">
            <div class="row text-center">
               <a href='javascript:void(0)' class='apply btn btn-primary col-6 mm-auto'>
                  {{__('Action')}}
               </a>
            </div>
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


<script>
   $(document).on('click', '.apply', function(e) {
      id = $(this).data('id');
      $.ajax({
         url: "{{route('notification.store')}}", 
         data: {
            "_token": "{{csrf_token()}}", 
            id: id,
            type: 'digital',
         }, 
         type: 'post', 
         success: function(result) {
            console.log("result", result);
            if (result) {
               $(".alert-success").removeClass('d-none');
               setTimeout(function() {
                  $(".alert-success").addClass('d-none');
               }, 4000)
               $("html, body").animate({
                  scrollTop: 0
               }, 500);
            } else {
               $(".alert-error").removeClass('d-none');
               setTimeout(function() {
                  $(".alert-error").addClass('d-none');
               }, 2000)
            }
         }
         , error: function(e) {
            console.log("error", e)
         }
      })
   });

</script>

@endsection
