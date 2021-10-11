@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
@component('components.dash_bread')
@slot('pagetitle') Drezon @endslot
@slot('title') Dashboard @endslot
@endcomponent
<div class="row">
   @component('dash.top', ['media' => $media, 'social_media' => $social_media,'clients' => $clients,'digital_marketing' => $digital_marketing, 'reports' => $reports])

   @endcomponent

</div>
<!-- end row-->

<style>
   .sitemessage {
      display: inline-block;
      white-space: nowrap;
      animation: floatText 15s infinite linear;
      padding-left: 100%;
      /*Initial offset*/
   }

   .sitemessage:hover {
      animation-play-state: paused;
   }

   @keyframes floatText {
      to {
         transform: translateX(-100%);
      }
   }

</style>



<div class="row">
   <div class="col-xl-6">
      @component('dash.invoice', ['invoice' => $invoice, 'invoice_pending' => $invoice_pending,'invoice_paid' => $invoice_paid,'invoice_unpaid' => $invoice_unpaid] )

      @endcomponent

      @component('dash.service', ['ads' => $ads])

      @endcomponent

      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-6 text-center">
                        <h1 class="text-muted mt-4 pt-2">
                        All What <br/> You Need <br/>In One Place
                        </h1>
                     </div>
                     <!-- end col-->
                     <div class="col-6">
                        <img src="{{ URL::asset('/assets/logo/dash-env.png') }}" alt="" class="img-fluid mx-auto">
                     </div>
                     <!-- end col-->
                  </div>
                  <!-- end row-->
               </div>
            </div>
         </div>
         <!-- end row-->
      </div>
   </div>
   <!-- end col-->



   <div class="col-xl-6">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title mb-5">Top Services</h4>

            <div class="card border rounded shadow-none mb-1">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-3 col-6">
                        <div class="media mb-sm-0 my-2">
                           <i class="mdi mdi-radiobox-marked text-danger h6 mb-0 mr-2"></i>
                           <div class="media-body">
                              <h6 class="mb-1"> Media</h6>
                              <p class="text-muted font-size-13 mb-0">Total {{$media}} </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-6">
                        <div class="media mb-sm-0 my-2">
                           <i class="mdi mdi-radiobox-marked text-primary h6 mb-0 mr-2"></i>
                           <div class="media-body">
                              <h6 class="mb-1"> Social Media</h6>
                              <p class="text-muted font-size-13 mb-0">Total {{$social_media}}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-6">
                        <div class="media mb-sm-0 my-2">
                           <i class="mdi mdi-radiobox-marked text-warning h6 mb-0 mr-2"></i>
                           <div class="media-body">
                              <h6 class="mb-1"> Digital Marketing</h6>
                              <p class="text-muted font-size-13 mb-0">Total {{$digital_marketing}}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-6">
                        <div class="media mb-sm-0 my-2">
                           <i class="mdi mdi-radiobox-marked text-light h6 mb-0 mr-2"></i>
                           <div class="media-body">
                              <h6 class="mb-1"> Creative</h6>
                              <p class="text-muted font-size-13 mb-0">Total {{$creative}}</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div>
               <div class="apex-charts" id="service-chart"></div>
            </div>
         </div>
      </div>
   </div>
   <!-- end col-->
</div>
<!-- end row-->
@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

<script>
   var service_media = <?php echo($service_media); ?>;
   var service_social_media = <?php echo($service_social_media);?> ;
   var service_digital_media = <?php echo($service_digital_media);?> ;
   var service_creative_media = <?php echo($service_creative_media);?> ;

   var options = {
      series: [{
            name: "Media"
            , data: service_media
         }
         , {
            name: "Social Media"
            , data: service_social_media
         }
         , {
            name: "Digital Marketing"
            , data: service_digital_media
         }
         , {
            name: "Creative"
            , data: service_creative_media
         }
      ]
      , chart: {
         type: "bar"
         , height: 250
         , stacked: true
         , stackType: "100%"
         , toolbar: {
            autoSelected: "pan"
            , show: false
         }
      }
      , plotOptions: {
         bar: {
            horizontal: false
            , columnWidth: "18%"
            , endingShape: "rounded"
         }
      }
      , dataLabels: {
         enabled: false
      },

      xaxis: {
         categories: [
            "Jan"
            , "Feb"
            , "Mar"
            , "Apr"
            , "May"
            , "Jun"
            , "Jul"
            , "Aug"
            , "Sep"
            , "Oct"
            , "Nov"
            , "Dec"
         ]
      }
      , fill: {
         opacity: 1
      }
      , legend: {
         show: false
      }
      , responsive: [{
         breakpoint: 576
         , options: {
            plotOptions: {
               bar: {
                  columnWidth: "45%"
               }
            }
            , stroke: {
               width: 2
            }
         }
      }]
      , colors: ["#ff556f", "#66C9BA", "#ffcf7e", "#e9eef2"]
   };

   var chart = new ApexCharts(document.querySelector("#service-chart"), options);
   chart.render();

</script>

@endsection
