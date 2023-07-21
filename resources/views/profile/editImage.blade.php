
<x-sg-master>
  <!-- add new patient -->
  <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Edit Profile Picture</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.pictureUpdate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" class="form-control"
                                value="{{$user->id}}">
                            <label>Upload Image:</label>	
                            <input name="image" type="file" class="file-input">
                            <img src="{{asset('images/profiles')}}/{{$user->profile_picture}}" width="100" class="img-fluid img-thumbnail mt-2">
                            <input name="oldimage" type="hidden" class="form-control" value="{{$user->profile_picture}}">
                           
                        
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary">Save<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
</x-sg-master>