<h4 class="card-title text-center fs-35">Calculation</h4>
<div class="row mt-5">

   <div class="col-md-3">
      <div class="form-group">
         <label for="platform">Platform</label>
         <select name="platform" id="platform" class="form-control" required>
            <option value="">Select Plateform</option>
         </select>
      </div>
   </div>

   <div class="col-md-3">
      <div class="form-group">
         <label for="campaign">Campaign Type</label>
         <select name="campaign" id="campaign" class="form-control" required>
            <option value="">Select Campaign Type</option>
         </select>
      </div>
   </div>

   <div class="col-md-2">
      <div class="form-group">
         <label for="result">Result Type</label>
         <select name="result" id="result" class="form-control" required>
            <option value="">Select Result Type</option>
         </select>
      </div>
   </div>

   <div class="col-md-2">
      <div class="form-group">
         <label for="budget">Budget</label>
         <input type="number" class="form-control" name="budget" id="budget" />
      </div>
   </div>

   <div class="col-md-5">
      <div class="form-group">
         <label for="platform text-danger">Estimated from</label>
         <input type="text" class="form-control" name="est_from" id="est_from" readonly />
      </div>
   </div>

   <div class="col-md-5">
      <div class="form-group">
         <label for="platform text-danger">Estimated to</label>
         <input type="text" class="form-control" name="est_to" id="est_to" readonly />
      </div>
   </div>

   <div class="col-md-2">
      <div class="form-group">
         <input type="button" class="calc btn btn-primary mm-auto mt-4" name="calcBtn" id="calcBtn" value="Calculation" />
         {{-- <a href='javascript:void(0)' class='calc btn btn-primary col-6 mm-auto' id="calc">
            Calc
         </a> --}}
      </div>
   </div>
</div>
