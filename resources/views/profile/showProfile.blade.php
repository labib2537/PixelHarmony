
@if(auth()->user()->id===$user->id)

<script>
        window.location.href = "{{ route('profile.show') }}";
</script>
  
@else

<x-sg-master>
    <!-- User details (with sample pattern) -->

    <div class="text-center">
    <h5 class="mb-3">{{$user->name}}'s Profile</h5>
    
</div>


    @if(Session::has('message'))
                    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>{{Session::get('message')}}</div>
                    @endif  
    
    <div class="card">
            <div class="card-body bg-blue text-center card-img-top"
                style="background-image: url(../global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
                <div class="card-img-actions d-inline-block mb-3">
                  
                @if($user->profile_picture=='https://cdn-icons-png.flaticon.com/512/3135/3135715.png')
                        <img class="img-fluid rounded-circle" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                        width="170" height="170" alt="">			
                        @else
                        <img class="img-fluid rounded-circle" src="{{asset('images/profiles')}}/{{$user->profile_picture}}"
                        width="170" height="170" alt="">
                        @endif
                                 
                </div>
    
                <h6 class="font-weight-semibold mb-0">{{$user->name}}</h6>
    
                
            </div>
    
            <div class="card-body border-top-0">
                <div class="d-sm-flex flex-sm-wrap mb-3">
                    <div class="font-weight-semibold">Full name:</div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->name}}</div>
                </div>
    
                <div class="d-sm-flex flex-sm-wrap mb-3">
                    <div class="font-weight-semibold">Email:</div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->email}}</div>
                </div>
    
                <div class="d-sm-flex flex-sm-wrap mb-3">
                    <div class="font-weight-semibold">Gender:</div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->gender ?? 'Gender'}}</div>
                </div>
    
                <div class="d-sm-flex flex-sm-wrap">
                    <div class="font-weight-semibold">Address:</div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->address ?? 'Address'}}</div>
                </div>
    
            </div>
            

        </div>
        @if(count($user->wallpapers)>0)
        <h5 class="ml-3">Wallpapers({{count($user->wallpapers)}})</h5>

<!-- show user wallpaper -->
<div class="m-4">


<div class="row" id="wallpaperRow">
        @foreach($user->wallpapers as $wallpaper)
        <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
        <div class="card card-img-actions rounded-0 border-0">
        <img class="card-img-top img-fluid  rounded-0 border-0" src="{{ asset('uploads/' . $wallpaper->image) }}" alt="${wallpaper.wallpaper_name}">
        <div class="card-img-actions-overlay card-img-top">
            <span class="badge bg-warning position-absolute top-0 start-0 p-2  rounded-0 border-0">{{$wallpaper->category}}</span>
            <button type="button" class="btn btn-outline bg-white text-white border-white border-2 legitRipple m-1" data-toggle="modal" data-target="#{{$wallpaper->uuid}}"><i class="icon-eye"></i></button>
            <a href="{{ asset('uploads/' . $wallpaper->image) }}" download class="btn btn-outline bg-white text-white border-white border-2 legitRipple m-1"><i class="icon-download4"></i></a>

        </div>
    </div>
</div>

<div id="{{$wallpaper->uuid}}" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{ $wallpaper->wallpaper_name }}</h6>
                <button type="button" class="close border-0 bg-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img class="card-img-top img-fluid" src="{{ asset('uploads/' . $wallpaper->image) }}" >
            </div>
        </div>
    </div>
</div>

        @endforeach 
    </div>
    </div>
    @endif

        
    
            
                            <!-- /user details (with sample pattern) -->
    </x-sg-master>
@endif