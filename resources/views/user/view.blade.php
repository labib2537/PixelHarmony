<x-sg-master>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

{{-- <form action="{{route('search_wallpaper')}}" method="get">
    @csrf --}}
<div class="input-group mb-4 search-bar">
<input type="text" id="searchInput" name="searchInput" class="form-control form-control-lg search-input mr-3" placeholder="Search wallpapers">
  <!-- <div class="input-group-append"> -->
  
    <button class="btn btn-warning search-button" type="submit" id="searchButton">
      <i class="fas fa-search mr-2"></i>Find Your Wallpaper
    </button>
   
  <!-- </div> -->
</div>
{{-- </form> --}}


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

        $('#searchInput').hide();

        $(document).on('click', '.search-button', function(e){
            e.preventDefault();
            $('#searchInput').show();
            $('#searchButton').html('<i class="fas fa-search"></i>');
        })

       
        
    // fetch all data

    // display all data

    function fetchAllWallpaper() {
        $.ajax({
            url: '{{ route('fetchAll_wallpaper') }}',
            method: 'get',
            success: function(res) {
                console.log(res);
                let wp = "";
                $.each(res, function(key, wallpaper) {
                    wp += '<div class="col-4 mb-3">'
                    wp += '<div class="card-img-actions">'
                    wp += `<img class="card-img-top img-fluid" src="{{ asset('uploads') }}/${wallpaper.image}" alt="${wallpaper.wallpaper_name}">`
                    wp +=  '<div class="card-img-actions-overlay card-img-top">'
                    wp += `<span class="badge badge-warning" style="position: absolute; top: 10px; left: 10px; z-index: 1; font-size: 15px; padding: 10px;">${wallpaper.category}</span>`
                    wp +=  `<button type="button" class="btn btn-outline bg-white text-white border-white border-2 legitRipple m-1" data-toggle="modal" data-target="#${wallpaper.uuid}"><i class="icon-eye"></i> </button>`
                    wp +=  `<button type="button" class="btn btn-outline bg-white text-white border-white border-2 legitRipple m-1" data-toggle="modal" data-target="#${wallpaper.uuid}"><i class="icon-pencil"></i> </button>`
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

    fetchAllWallpaper();


     //search data

        $(document).on('keyup', function(e){
            e.preventDefault();
            let search = $('#searchInput').val();
            $.ajax({
                url: '{{ route('search') }}',
                method: 'GET',
                data: {search: search},
                success: function(res){
                    // console.log(res);
                    if(res.status==250)
                    {
                        let wp = "";
                $.each(res, function(key, wallpaper) {
                    wp += '<div class="col-12 mb-3">'
                
                    wp += '<p class="not-found-message">No wallpapers found!</p>'
                
                    wp +=  '</div>';
                });
                $('#wallpaperRow').html(wp);
                    }else{
                        let wp = "";
                $.each(res, function(key, wallpaper) {
                    wp += '<div class="col-4 mb-3">'
                    wp += '<div class="card-img-actions">'
                    wp += `<img class="card-img-top img-fluid" src="{{ asset('uploads') }}/${wallpaper.image}" alt="${wallpaper.wallpaper_name}">`
                    wp +=  '<div class="card-img-actions-overlay card-img-top">'
                    wp +=  `<button type="button" class="btn btn-outline bg-white text-white border-white border-2 legitRipple m-1" data-toggle="modal" data-target="#${wallpaper.uuid}"><i class="icon-eye"></i> </button>`
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
                }
            });

        })

        // delete wallpaper
        $(document).on('click', '.deleteWallpaper', function(e){
           e.preventDefault();
           let id = $(this).attr('id');
           Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
        //   icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
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
                   'Deleted!',
                   'Wallpaper has been Deleted Successfully',
                   'Success'
                 )
                 fetchAllWallpaper();
               }
            });
          }
        });
        });




       

    </script>





</x-sg-master>
