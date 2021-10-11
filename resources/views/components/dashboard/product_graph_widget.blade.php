<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="media align-items-center">
                <div class="avatar-sm mr-3 p-1 border rounded border-soft-primary">
                    <div class="avatar-title rounded bg-soft-primary text-primary">
                        {{$icon}}
                    </div>
                </div>
                <div class="media-body">
                    <h5 class="mt-0 mb-1 font-size-15"><a href="#" class="text-dark">{{ $title }}</a></h5>
                    
                </div>
            </div>
            <div class="row align-items-center mt-4">
                <div class="col-7">
                    <h6 class="mb-1 font-size-15">{{ $value }} <span class="text-muted font-size-13 ml-1"></span></h6>
                    <a href="#" class="h6 font-weight-normal text-muted">{{ $price }}</a>
                </div>
                <!-- end col-->
                <div class="col-5">
                    <div>
                        <div class="apex-charts" id="{{ $chart }}"></div>
                    </div>
                </div>
                <!-- end col-->
            </div>
            <!-- end row-->
        </div>
    </div>
</div>