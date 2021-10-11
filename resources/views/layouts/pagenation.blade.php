<div class="col-sm-6">
   <div>
      <p class="mb-sm-0">Page {{$paginator->currentPage()}} of {{$paginator->lastPage()}}</p>
   </div>
</div>
<div class="col-sm-6">
   <div class="float-sm-right">
      <ul class="pagination pagination-rounded mb-sm-0">
         @if ($paginator->onFirstPage())
               <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                  <span class="page-link" aria-hidden="true">&lsaquo;</span>
               </li>
         @else
               <li class="page-item">
                  <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
               </li>
         @endif
         @foreach ($elements as $element)
            @if (is_string($element))
               <li class="page-item disable">
                  <a href="#" class="page-link">00</a>
               </li>
            @endif
            @if (is_array($element))
               @foreach ($element as $page => $url)
                  @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                  @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                  @endif
               @endforeach
            @endif
         @endforeach

         @if ($paginator->hasMorePages())
               <li class="page-item">
                  <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
               </li>
         @else
               <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                  <span class="page-link" aria-hidden="true">&rsaquo;</span>
               </li>
         @endif
         {{-- <li class="page-item">
            <a href="#" class="page-link">1</a>
         </li>
         <li class="page-item active">
            <a href="#" class="page-link">2</a>
         </li>
         <li class="page-item">
            <a href="#" class="page-link">3</a>
         </li>
         <li class="page-item">
            <a href="#" class="page-link">4</a>
         </li>
         <li class="page-item">
            <a href="#" class="page-link">5</a>
         </li>
         <li class="page-item">
            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
         </li> --}}
      </ul>
   </div>
</div>
