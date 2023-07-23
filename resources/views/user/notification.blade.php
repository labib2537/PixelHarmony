@php
use Carbon\Carbon;
@endphp
<x-sg-master>

    <div class="text-center">
        <h6>All Notifications</h6>
    </div>

    <div class="dropdown-content-header">
							<span class="font-size-sm line-height-sm text-uppercase font-weight-semibold">All activity</span>
						</div>

						<div class="dropdown-content-body dropdown-scrollable">
							<ul class="media-list">


								@foreach($notifications as $notification)
							

                                @php
                                 $isUnread = Auth::user()->notifications->contains(function ($item) use ($notification) {
                                   return $item->id === $notification->id && !$item->pivot->is_read;
                                 });
                                 @endphp

                                @if ($isUnread)
								
								<li class="media clickable-notification" data-href="{{ route('notify.click', ['id' => $notification->id]) }}">
                                 <div class="mr-3">
                                     <a href="{{ route('profile.user2', ['id' => $notification->user->id]) }}">
                                     @if($notification->user->profile_picture === "https://cdn-icons-png.flaticon.com/512/3135/3135715.png")
                                         <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="rounded-circle" width="40" height="40" alt="">
                                     @else 
                                         <img src="{{ asset('images/profiles/' . $notification->user->profile_picture) }}" class="rounded-circle" width="40" height="40" alt="">
                                     @endif
                                     </a>
                                 </div>

                                 <div class="media-body">
                                     <b><a href="{{ route('profile.user2', ['id' => $notification->user->id]) }}">
                                         {{ $notification->user->name }}
                                     </a> uploaded a new wallpaper</b>
                                     <div class="font-size-sm text-muted mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                                 </div>
                             </li>
								

								@else
								<li class="media">
									<div class="mr-3">
									<a href="{{ route('profile.user2', ['id' => $notification->user->id]) }}">
									@if($notification->user->profile_picture === "https://cdn-icons-png.flaticon.com/512/3135/3135715.png")
                                      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="rounded-circle" width="40" height="40" alt="">
                                    @else 
                                    <img src="{{ asset('images/profiles/' . $notification->user->profile_picture) }}" class="rounded-circle" width="40" height="40" alt="">
                                    @endif
									</a>
									</div>

									<div class="media-body">
									
									<a href="{{ route('profile.user2', ['id' => $notification->user->id]) }}">
                                      {{ $notification->user->name }}
                                    </a> uploaded a new wallpaper
									
                                    <div class="font-size-sm text-muted mt-1">
                                      @if ($notification->created_at->diffInMinutes() < 60)
                                          {{ $notification->created_at->diffInMinutes() . ' minutes ago' }}
                                      @elseif ($notification->created_at->diffInHours() < 24)
                                          {{ $notification->created_at->diffInHours() . ' hours ago' }}
                                      @elseif ($notification->created_at->diffInDays() < 2)
                                          {{ 'Yesterday' }}
                                      @elseif ($notification->created_at->diffInDays() < 7)
                                     {{ $notification->created_at->format('l') }} {{-- Day of the week (e.g., Sunday) --}}
                                      @else
                                          {{ $notification->created_at->format('D, d F Y') }} {{-- Custom format for older dates --}}
                                      @endif
                                    </div>

									</div>
								</li>
								@endif
								@endforeach
								

							</ul>
						</div>
                        <script>
    const clickableNotifications = document.querySelectorAll('.clickable-notification');
    clickableNotifications.forEach(li => {
        li.addEventListener('click', function() {
            const href = this.dataset.href;
            if (href) {
                window.location.href = href;
            }
        });
    });
</script>


</x-sg-master>