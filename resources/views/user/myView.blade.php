<x-sg-master>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<div class="text-center">
<span class="d-inline-block border-bottom border-warning"><h4>My Wallpapers<h4></span>
</div>

<a href="{{route('wallpaper.trash')}}" class="btn bg-danger-400 btn-labeled btn-labeled-left rounded-round legitRipple mb-3"><b><i class="icon-trash"></i></b> Trash</a>

<!-- edit form -->
<div id="modal_edit_wallpaper" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
                            
                            <form action="#" method="post" id="edit_data" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control" name="id" id="id" required>
                                    <input type="hidden" class="form-control" name="uuid" id="uuid" required>
									<div class="modal-body">
                                        <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
										<label>Wallpaper Name:</label>
										<input type="text" name="wp_name" class="form-control" placeholder="EX: Blue Beautiful Bird" id="name" required>
									</div>
                                        </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
										<label>Wallpaper Category:</label>
                                        <select name="category" data-placeholder="Select your wallpaper category" class="form-control form-control-select2" id="category" data-fouc required>
											<option></option>
											
												<option>Nature's Beauty</option>
												<option>Urban Landscapes</option>
												<option>Abstract Art</option>
												<option>Inspirational Quotes</option>
												<option>Minimalist Designs</option>
												<option>Animal Kingdom</option>
												<option>Fantasy Worlds</option>
												<option>Vintage Vibes</option>
												<option>Space and Astronomy</option>
												<option>Travel and Adventure</option>
												<option>Hill and Mountain</option>
												<option>Architectural Wonders</option>
												<option>Ocean and river</option>
                                                <option>Bird Kingdom</option>
                                                <option>Floral Delights</option>
												<option>Colorful Creations</option>
												<option>Medical and Chemical</option>
												<option>Celebrities and Icons</option>
                                                <option>Digital Art</option>
												<option>Technology and Gadgets</option>
												<option>Sports and Fitness</option>
										</select>

									</div>
                                    </div>
                                </div>

                                        </div>
                                    </div>
                                    
								<div class="modal-footer">
									<button type="submit" id="update_btn" class="btn bg-orange ml-3 legitRipple"><i class="icon-checkmark3 mr-2"></i>Save</button>
								</div>
				</form>
                            

                </div>
            </div>
        </div>
<!-- end edit form -->

<!-- <div id="searchResults" class="list-group search-results"></div> -->



    <div class="row" id="wallpaperRow">
  {{--   @foreach($wallpapers as $wallpaper)
        <div class="col-4 mb-3">
            <div class="card-img-actions">
                <img class="card-img-top img-fluid" src="{{ asset('uploads/' . $wallpaper->image) }}" alt="{{ $wallpaper->wallpaper_name }}">
                <div class="card-img-actions-overlay card-img-top">
                    <button type="button" class="btn btn-outline bg-white text-white border-white border-2 legitRipple" data-toggle="modal" data-target="#{{$wallpaper->uuid}}">Preview </button>
                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 ml-2 legitRipple">Details</a>
                </div>
            </div>
        </div>
        <!-- Full width modal -->
				<div id="{{$wallpaper->uuid}}" class="modal fade" tabindex="-1">
					<div class="modal-dialog modal-full">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{{$wallpaper->wallpaper_name}}</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
                            <div class="modal-body">
                            <img class="card-img-top img-fluid" src="{{ asset('uploads/' . $wallpaper->image) }}" alt="{{ $wallpaper->wallpaper_name }}">
							</div>
							
						</div>
					</div>
				</div>
				<!-- /full width modal -->
    @endforeach --}}
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>


       
        
    // fetch all data

    // display all data

    function fetchMyWallpaper() {
        $.ajax({
            url: '{{ route('fetchMy_wallpaper') }}',
            method: 'get',
            success: function(res) {
                console.log(res);
                let wp = "";
                $.each(res, function(key, wallpaper) {
                    wp += '<div class="col-xl-4 col-md-12 col-lg-6 col-sm-12 mb-3">'
                    wp += '<div class="card-img-actions">'
                    wp += `<img class="card-img-top img-fluid" src="{{ asset('uploads') }}/${wallpaper.image}" alt="${wallpaper.wallpaper_name}">`
                    wp +=  '<div class="card-img-actions-overlay card-img-top">'
                    wp += `<span class="badge badge-warning" style="position: absolute; top: 10px; left: 10px; z-index: 1; font-size: 15px; padding: 10px;">${wallpaper.category}</span>`
                    wp +=  `<button type="button" class="btn btn-outline bg-white text-white border-white border-2 legitRipple m-1" data-toggle="modal" data-target="#${wallpaper.uuid}"><i class="icon-eye"></i> </button>`
                    wp +=  `<button class="btn btn-outline bg-white text-white border-white border-2 legitRipple editWallpaper m-1" id="${wallpaper.id}" data-toggle="modal" data-target="#modal_edit_wallpaper"><i class="icon-pencil"></i> </button>`
                    wp +=  `<button class="btn btn-outline bg-white text-white border-white border-2 legitRipple deleteWallpaper m-1" id="${wallpaper.id}"><i class="icon-trash"></i> </button>`
                    wp +=  '</div>'
                    wp +=  '</div>'
                    wp +=  '</div>';

                    wp +=  `<div id="${wallpaper.uuid}" class="modal fade" tabindex="-1">`
                    wp +=  '<div class="modal-dialog modal-full">'
                    wp +=  '<div class="modal-content">';
                    wp +=  '<div class="modal-header">'
                    wp +=  `<h5 class="modal-title">${wallpaper.wallpaper_name}</h5>`
                    wp +=  '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    wp +=  '</div>';
                    wp +=  '<div class="modal-body">';
                    wp +=  `<img class="card-img-top img-fluid" src="{{ asset('uploads') }}/${wallpaper.image}" alt="${wallpaper.wallpaper_name}">`;
                    wp +=  '</div>';
                    wp +=  '</div>';
                    wp +=  '</div>';
                    wp +=  '</div>';
                });
                $('#wallpaperRow').html(wp);
            }
        });
    }

    fetchMyWallpaper();

        // delete wallpaper
        $(document).on('click', '.deleteWallpaper', function(e){
           e.preventDefault();
           let id = $(this).attr('id');
           Swal.fire({
          title: 'Are you sure?',
          text: "Your wallpaper will move into trash!",
        //   icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, move it!'
        }).then((result) => {
            
          if (result.isConfirmed) {
            $.ajax({
               url: '{{ route('delete_wallpaper') }}',
               method: 'post',
               data:{
                id: id,
                _token: '{{ csrf_token() }}'
               },
               success: function(res){
                Swal.fire(
                   'Trashed!',
                   'Wallpaper has been moved into trash',
                   'Success'
                 )
                 fetchMyWallpaper();
               }
            });
          }
        });
        });

          // edit wallpaper info

          $(document).on('click', '.editWallpaper', function(e){
          e.preventDefault();
          let id = $(this).attr('id');
          $.ajax({
            method: "post",
            url: '{{ route('edit_wallpaper') }}',
            data:{
                id: id,
                _token: '{{ csrf_token() }}'
               },
            success: function(wallpaper){
              console.log(wallpaper);
              $('#id').val(wallpaper.id);
              $('#uuid').val(wallpaper.uuid);
              $('#name').val(wallpaper.wallpaper_name);
              $('#category').val(wallpaper.category).trigger('change');
            }

          })
        }); 

        //update wallpaper

        $("#edit_data").submit(function(e){
            e.preventDefault();
            const fd = new FormData(this);
            var editButton = $('#update_btn');
            editButton.addClass('disabled').attr('disabled', true).text('Saving...');
            $.ajax({
                method: "post",
                url: '{{ route('update_wallpaper') }}',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){

                    if(res.status==200){
                        swal.fire(
                            'Updated!',
                            'Wallpaper Updated Successfully',
                            'Success'
                        );
                    }
                    
                    $('#modal_edit_wallpaper').modal('hide');
                    editButton.removeClass('disabled').attr('disabled', false).html('<i class="icon-checkmark3 mr-2"></i>Save');
                    fetchMyWallpaper();

                }

            });
        });


       

    </script>





</x-sg-master>
