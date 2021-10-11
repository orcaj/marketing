<div class="card">
   <div class="card-body">
      <div class="text-slider">

         <ul class="list-inline mb-0 sitemessage">
            @foreach ($ads as $ad)
            <li class="list-inline-item mr-5 pr-5">
               <div class="media">
                  <div class="media-body">
                     <h6 class="my-0">{{$ad->msg}}</h6>
                     <p class="text-muted mb-0"></p>
                  </div>
               </div>
            </li>
            @endforeach
         </ul>
      </div>
   </div>
</div>
