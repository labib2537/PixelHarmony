<x-sg-master>

<div class="card">
							<div class="card-header header-elements-inline bg-dark">
				                <h6 class="card-title ">Upload Your Wallpaper</h6>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		<a class="list-icons-item" data-action="remove"></a>
				                	</div>
			                	</div>
							</div>


			                <div class="card-body">
			                	<form action="#" method="post" id="insert_data" enctype="multipart/form-data">
                                    @csrf
									
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
										<label>Wallpaper Name:</label>
										<input type="text" name="wp_name" class="form-control" placeholder="EX: Blue Beautiful Bird" required>
									</div>
                                        </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
										<label>Wallpaper Category:</label>
                                        <select name="category" data-placeholder="Select your wallpaper category" class="form-control form-control-select2" data-fouc required>
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

                                     <!-- file uploader -->

                    <div class="form-group">
                    <label>Upload Wallpaper:</label>
                    <input name="image" type="file" class="file-input" data-fouc required>
                    </div>

                                    

									

									<div class="d-flex justify-content-between align-items-center">
										<span><i class="icon-spinner2 spinner mr-2"></i> Processing...</span>
										<button type="submit" id="add_btn" class="btn bg-orange ml-3 legitRipple"><i class="icon-checkmark3 mr-2"></i>Save</button>
									</div>
				</form>
							</div>
		                </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    


    $('#insert_data').submit(function(e){
        e.preventDefault();
        const fd = new FormData(this);
        var addButton = $('#add_btn');
        addButton.addClass('disabled').attr('disabled', true).text('Saving...');

        $.ajax({
            url: '{{ route('store_wallpaper') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,

            success: function(res){
                if(res.status==200){
                    swal.fire(
                            'Added!',
                            'Wallpaper Uploaded Successfully',
                            'Success'
                        )
                        $('#insert_data')[0].reset();
                        addButton.removeClass('disabled').attr('disabled', false).html('<i class="icon-checkmark3 mr-2"></i>Save');

                }
            }
        });
    })
    </script>    

</x-sg-master>