<x-sg-master>
    <!-- User details (with sample pattern) -->

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
                        <div class="card-img-actions-overlay card-img rounded-circle">
										<a href="{{route('profile.add_image')}}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple">
											<i class="icon-plus3"></i>
										</a>				
						</div>
                        @else
                        <img class="img-fluid rounded-circle" src="{{asset('images/profiles')}}/{{$user->profile_picture}}"
                        width="170" height="170" alt="">
                        <div class="card-img-actions-overlay card-img rounded-circle">
										<a href="{{route('profile.edit_image')}}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple">
											<i class="icon-pencil"></i>
										</a>
										<form action="{{route('profile.imageRemove')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" class="form-control"
                                             value="{{$user->id}}">
                                            <button class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 legitRipple" onclick="return confirm('Are you sure?')">
											<i class="icon-trash"></i>
                        </button>
                        </form>
									</div>      
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
                    <div class="font-weight-semibold">Phone Number:</div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->phoneNumber ?? 'Your Phone Number'}}</div>
                </div>
    
                <div class="d-sm-flex flex-sm-wrap mb-3">
                    <div class="font-weight-semibold">Gender:</div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->gender ?? 'Your Gender'}}</div>
                </div>
    
                <div class="d-sm-flex flex-sm-wrap">
                    <div class="font-weight-semibold">Address:</div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->address ?? 'Your Address'}}</div>
                </div>
                <form action="{{route('profile.edit2')}}" method="get">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="submit"  class="btn bg-teal btn-ladda btn-ladda-progress float-right mt-3" data-style="expand-left" data-spinner-size="20" name="submit" value="Edit Profile">
                </form>
    
            </div>
        </div>
    
            
                            <!-- /user details (with sample pattern) -->
    </x-sg-master>
