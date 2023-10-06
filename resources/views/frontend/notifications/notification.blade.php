@extends('frontend.layouts.app')
@section('title','Notification')
@section('content')
           <div class="notification">
           @if($notifications->count()>0)
                <div class="infinite-scroll">
                    @foreach($notifications as $notification)
                        <a href="{{ route('notification-show',$notification->id) }}">
                            <div class="card mb-2 @if(is_null($notification->read_at)) text-danger @endif">
                                <div class="card-body p-2">
                                   <h6>{{ Illuminate\Support\Str::limit($notification->data['title'],40,'...') }}</h6>
                                   <p class="mb-1">{{ Illuminate\Support\Str::limit($notification->data['message'],100,'...') }}</p>
                                   <p class=" @if(is_null($notification->read_at)) text-danger @else text-muted @endif  mb-1">{{ Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s A')}}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    {{$notifications->links()}}
                </div>
           @else
               <p class=" text-center text-danger font-weight-bold">
                     No record found!
               </p> 
           @endif
           </div>
@endsection
@push('script')
<script src="{{ asset('frontend/js/jscroll.jquery.js') }}"></script>
<script src="{{ asset('frontend/js/moment.min.js') }}"></script>
<script src="{{ asset('frontend/js/daterangepicker.js') }}"></script>
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
@endpush