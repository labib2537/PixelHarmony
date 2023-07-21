<x-sg-master>
  <!-- add new patient -->
  <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Edit Profile Information</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update2') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <input type="hidden" name="id" class="form-control"
                                value="{{$user->id}}">
                          
                            <div class="form-group">
                                <label>Name:</label>
                                <input name="name" type="text" class="form-control" placeholder="Name" 
                                value="{{$user->name}}" required>
                            </div>
                            <div class="form-group">
                                <label>Phone:</label>
                                <input name="phone" type="text" class="form-control" placeholder="EX: 017XXXXXXXX"
                                value="{{$user->phoneNumber}}" required>
                            </div>
                            <div class="form-group">
                                <label>Gender:</label>
                                <input name="gender" type="text" class="form-control" placeholder="Male" value="<?=$user->gender?>" required>
                            </div>
                            <div class="form-group">
                                <label>Address:</label>
                                <input name="address" type="text" class="form-control" placeholder="Address" value="<?=$user->address?>" required>
                            </div>
                              
                        </fieldset>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary">Save<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
</x-sg-master>

