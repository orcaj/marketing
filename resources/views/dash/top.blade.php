@component('components.dashboard.product_graph_widget')
   @slot('icon') 
      <img src="{{asset('assets/logo/dash/media.png')}}" width="20" />
   @endslot
   @slot('title') Media @endslot
   @slot('value') Total No. {{$media}}  @endslot
   @slot('price')  @endslot
   @slot('chart') sparkline-chart-1 @endslot
@endcomponent
@component('components.dashboard.product_graph_widget')
   @slot('icon') <img src="{{asset('assets/logo/dash/social-media.png')}}" width="20" /> @endslot
   @slot('title') Social media @endslot
   @slot('value') Total No. {{$social_media}}@endslot
   @slot('price')  @endslot
   @slot('chart') sparkline-chart-2 @endslot
@endcomponent


@component('components.dashboard.product_graph_widget')
   @if(permission('manager'))
      @slot('icon') <img src="{{asset('assets/logo/dash/media.png')}}" width="20" /> @endslot
      @slot('title') Clients @endslot
      @slot('value') Total No. {{$clients}}@endslot
      @slot('price')  @endslot
      @slot('chart') sparkline-chart-3 @endslot
   @else
      @slot('icon') <img src="{{asset('assets/logo/dash/additional-report.png')}}" width="20" /> @endslot
      @slot('title') Reports @endslot
      @slot('value') Total No. {{$reports}}@endslot
      @slot('price')  @endslot
      @slot('chart') sparkline-chart-3 @endslot
   @endif
@endcomponent



@component('components.dashboard.product_graph_widget')
   @slot('icon') <img src="{{asset('assets/logo/dash/digital-marketing.png')}}" width="20" /> @endslot
   @slot('title') Digital Marketing @endslot
   @slot('value') Total No. {{$digital_marketing}}@endslot
   @slot('price')  @endslot
   @slot('chart') sparkline-chart-4 @endslot
@endcomponent