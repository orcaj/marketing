<div class="card">
   <div class="card-body">
      <h4 class="card-title mb-4">Invoices</h4>
      <div class="row align-items-end">
         <div class="col-lg-5">
               <div class="pr-lg-5">
                  <h4 class="font-weight-bold mb-3">{{$invoice}} <span class="text-muted font-size-14 font-weight-normal ml-1">Invoices</span></h4>
                  <div class="progress rounded-pill">
                     <div class="progress-bar" role="progressbar" style="{{'width: '.($invoice != 0 ? $invoice_pending/$invoice*100 : 0).'%'}}" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                     <div class="progress-bar bg-success" role="progressbar" style="{{'width: '.($invoice != 0 ? $invoice_paid/$invoice*100 : 0).'%'}}" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                     <div class="progress-bar bg-danger" role="progressbar" style="{{'width: '.($invoice != 0 ? $invoice_unpaid/$invoice*100 : 0).'%'}}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
               </div>
         </div>
         <!-- end col-->
         <div class="col-lg-7">
               <div class="row mt-lg-0 mt-4">
                  <div class="col-md-4">
                     <div class="media mb-sm-0 mb-4">
                           <i class="bx bxs-circle font-size-12 text-warning mr-2"></i>
                           <div class="media-body">
                              <h6 class="mb-2">Pending</h6>
                              <p class="text-muted mb-0">{{$invoice_pending}}</p>
                           </div>
                     </div>
                  </div>
                  <!-- end col-->
                  <div class="col-md-4">
                     <div class="media mb-sm-0 mb-4">
                           <i class="bx bxs-circle font-size-12 text-success mr-2"></i>
                           <div class="media-body">
                              <h6 class="mb-2">Paid</h6>
                              <p class="text-muted mb-0">{{$invoice_paid}} </p>
                           </div>
                     </div>
                  </div>
                  <!-- end col-->
                  <div class="col-md-4">
                     <div class="media mb-sm-0 mb-4">
                           <i class="bx bxs-circle font-size-12 text-danger mr-2"></i>
                           <div class="media-body">
                              <h6 class="mb-2">Not Paid</h6>
                              <p class="text-muted mb-0">{{$invoice_unpaid}}</p>
                           </div>
                     </div>
                  </div>
                  <!-- end col-->
               </div>
               <!-- end roe-->
         </div>
         <!-- end col-->
      </div>
      <!-- end row-->
   </div>
</div>