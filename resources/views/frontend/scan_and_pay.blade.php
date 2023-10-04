@extends('frontend.layouts.app')
@section('title','Scan & Pay')
@section('content')
   <div class="scan-and-pay">
        <div class="card">
            <div class="card-body text-center">
            @include('frontend.layouts.page_info')
                <div class="text-center">
                    <img src="{{ asset('frontend/images/scan.png') }}" alt="">
                </div>
                <p class="mb-3 mt-4">Click button, put QR code in the frame and pay.</p>
                <button class="btn btn-theme " data-bs-toggle="modal" data-bs-target="#scanModal">Scan</button>
                <!-- Modal -->
                <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scanModalLabel">Scan & Pay</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <video id="scanner" style="width:100%;height:240px;"></video>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
   </div>         
@endsection
@push('script')
<!-- <script src="{{ asset('frontend/js/qr-scanner-worker.min.js') }}"></script>
<script src="{{ asset('frontend/js/qr-scanner-worker.min.js.map') }}"></script>
<script src="{{ asset('frontend/js/qr-scanner.min.js') }}"></script>
<script src="{{ asset('frontend/js/qr-scanner.min.js.map') }}"></script> -->
<script src="{{ asset('frontend/js/qr-scanner.umd.min.js') }}"></script>
<!-- <script src="{{ asset('frontend/js/qr-scanner.umd.min.js.map') }}"></script> -->
<script type="text/javascript">
   $('.document').ready(function(){
        var videoElem = document.getElementById('scanner')
        const qrScanner = new QrScanner(videoElem,function(result){ 
            if(result){
                qrScanner.stop();
                $('#scanModal').modal('hide');
                var phone = result;
                window.location.replace(`scan-and-pay-form?phone=${phone}`);
            }
            console.log(result);
        });

        var myModalEl = document.getElementById('scanModal')
        myModalEl.addEventListener('show.bs.modal', function (event) {
            qrScanner.start();
        });
        var myModalEl = document.getElementById('scanModal')
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            qrScanner.stop();
        });
   });
</script>
@endpush
