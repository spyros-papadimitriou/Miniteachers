@if (count($globalUser->notifications) > 0)
<div aria-live="polite" aria-atomic="true" style="position: relative; ">
    <!-- Position it -->
    <div style="position: fixed; bottom: 10px; right: 10px; z-index: 2000;">

        <!-- Then put toasts within -->
        @foreach ($globalUser->notifications as $notification)
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay='{{ $loop->iteration * 3000 }}'>
            <div class="toast-header">
                <img src="{{ asset('svg/points.svg') }}" height="16" class="rounded mr-2" alt="">
                <strong class="mr-auto">{{ $notification->title }}</strong>
                <small class="text-muted">{{ $notification->created_at }}</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {!! $notification->content !!}
            </div>
        </div>
        @endforeach
    </div>

</div>
@endif