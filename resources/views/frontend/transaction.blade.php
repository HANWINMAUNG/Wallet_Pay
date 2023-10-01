@extends('frontend.layouts.app')
@section('title','Transaction')
@section('content')
   <div class="transaction">
        <div class="card mb-2">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-6">
                            <!-- <div class="form-group input-group my-2">
                                <label class="input-group-text p-1">Type</label>
                                <select class="custom-select form-control">
                                    <option value="">All</option>
                                    <option value="1">Income</option>
                                    <option value="2">Expense</option>
                                </select>
                            </div> -->
                    </div>
                    <div class="col-6">
                            <div class=" form-group input-group my-2">
                                <label class="input-group-text p-1">Type</label>
                                <select class="custom-select form-control type">
                                    <option value="">All</option>
                                    <option value="1" @if(request()->type == 1) selected @endif>Income</option>
                                    <option value="2" @if(request()->type == 2) selected @endif>Expense</option>
                                </select>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="infinite-scroll">
            @foreach($transactions as $transaction)
                <a href="{{ route('transaction-detail',$transaction->trx_no) }}">
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">TRX ID : {{ $transaction->trx_no }}</h6>
                                @if($transaction->type == 1)
                                <p class="mb-1 text-success">+{{ $transaction->amount }} <small>MMK</small></p>
                                @elseif($transaction->type == 2)
                                <p class="mb-1 text-danger">-{{ $transaction->amount }} <small>MMK</small></p>
                                @endif
                            </div>
                            <p class="mb-1 text-muted">
                                @if($transaction->type == 1)
                                <span class="text-success">From</span>
                                @elseif($transaction->type == 2)
                                <span class="text-danger">To</span>
                                @endif 
                                -{{ $transaction->Source ? $transaction->Source->name : '' }}
                            </p>
                            <p class="mb-1 text-muted">{{ $transaction->created_at }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
            {{$transactions->links()}}
        </div>
   </div>         
@endsection
@push('script')
<script src="{{ asset('frontend/js/jscroll.jquery.js') }}"></script>
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
        $('.type').change(function(){
            var type = $('.type').val();
            history.pushState(null,'',`?type=${type}`);
            window.location.reload();
        })
    });
</script>
@endpush