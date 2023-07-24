<x-sg-master>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<div class="text-center">
<span class="d-inline-block border-bottom border-warning"><h4>Trash<h4></span>
</div>


<!-- <div id="searchResults" class="list-group search-results"></div> -->



    <div class="row" id="wallpaperRow">

    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>


       
        
    // fetch all data

    // display all data

    function fetchTrashWallpaper() {
        $.ajax({
            url: '{{ route('fetchTrash_wallpaper') }}',
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
                    wp +=  `<button class="btn btn-outline bg-white text-white border-white border-2 legitRipple restoreWallpaper m-1" id="${wallpaper.id}"><i class="icon-rotate-cw3"></i> </button>`
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

    fetchTrashWallpaper();

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
               url: '{{ route('deletePermanent_wallpaper') }}',
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
                 fetchTrashWallpaper();
               }
            });
          }
        });
        });


         // restore wallpaper
         $(document).on('click', '.restoreWallpaper', function(e){
           e.preventDefault();
           let id = $(this).attr('id');
           Swal.fire({
          title: 'Are you sure?',
          text: "This restore will be available on your wallpaper!",
        //   icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#2AAA8A',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            
          if (result.isConfirmed) {
            $.ajax({
               url: '{{ route('restore.wallpaper') }}',
               method: 'post',
               data:{
                id: id,
                _token: '{{ csrf_token() }}'
               },
               success: function(res){
                Swal.fire(
                   'Restored!',
                   'Wallpaper has been restored Successfully',
                   'Success'
                 )
                 fetchTrashWallpaper();
               }
            });
          }
        });
        });



       

    </script>





</x-sg-master>
