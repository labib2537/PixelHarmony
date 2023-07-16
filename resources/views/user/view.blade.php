<x-sg-master>

<form action="{{route('search_wallpaper')}}" method="get">
    @csrf 
<div class="input-group mb-4 search-bar">
<input type="text" id="searchInput" name="searchInput" class="form-control form-control-lg search-input mr-3" placeholder="Search wallpapers">
  <!-- <div class="input-group-append"> -->
  
    <button class="btn btn-warning search-button" type="submit" id="searchButton">
      <i class="fas fa-search"></i>
    </button>
   
  <!-- </div> -->
</div>
 </form> 


<!-- <div id="searchResults" class="list-group search-results"></div> -->



    <div class="row" id="wallpaperRow">
    @foreach($wallpapers as $wallpaper)
        <div class="col-4 mb-3">
            <div class="card-img-actions">
                <img class="card-img-top img-fluid" src="{{ asset('uploads/' . $wallpaper->image) }}" alt="{{ $wallpaper->wallpaper_name }}">
                <div class="card-img-actions-overlay card-img-top">
                    <a href="{{ asset('uploads/' . $wallpaper->image) }}" class="btn btn-outline bg-white text-white border-white border-2 legitRipple" data-popup="lightbox">Preview</a>
                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 ml-2 legitRipple">Details</a>
                </div>
            </div>
        </div>
    @endforeach 
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        // $('#searchInput').hide();

        // $(document).on('click', '.search-button', function(e){
        //     e.preventDefault();
        //     $('#searchInput').show();
        //     $('#searchButton').html('<i class="fas fa-search"></i>');
        // })

       
        
    // fetch all data

    // display all data

    // function fetchAllWallpaper() {
    //     $.ajax({
    //         url: '{{ route('fetchAll_wallpaper') }}',
    //         method: 'get',
    //         success: function(res) {
    //             console.log(res);
    //             let wp = "";
    //             $.each(res, function(key, wallpaper) {
    //                 wp += `<div class="col-4 mb-3">
    //                             <div class="card-img-actions">
    //                             <img class="card-img-top img-fluid" src="{{ asset('uploads') }}/${wallpaper.image}" alt="${wallpaper.wallpaper_name}">
    //                                 <div class="card-img-actions-overlay card-img-top">
    //                                     <a href="{{ asset('uploads') }}/${wallpaper.image}" class="btn btn-outline bg-white text-white border-white border-2 legitRipple" data-popup="lightbox">
    //                                         Preview
    //                                     </a>
    //                                     <a href="#" class="btn btn-outline bg-white text-white border-white border-2 ml-2 legitRipple">
    //                                         Details
    //                                     </a>
    //                                 </div>
    //                             </div>
    //                         </div>`;
    //             });
    //             $('#wallpaperRow').append(wp);
    //         }
    //     });
    // }

    // fetchAllWallpaper();


     //search data

        // $(document).on('keyup', function(e){
        //     e.preventDefault();
        //     let search = $('#searchInput').val();
        //     $.ajax({
        //         url: '{{ route('search') }}',
        //         method: 'GET',
        //         data: {search: search},
        //         success: function(res){
        //             // console.log(res);
        //             if(res.status==250)
        //             {
        //                 let wp = "";
        //         $.each(res, function(key, wallpaper) {
        //             wp += '<div class="col-12 mb-3">'
                
        //             wp += '<p class="not-found-message">No wallpapers found!</p>'
                
        //             wp +=  '</div>';
        //         });
        //         $('#wallpaperRow').html(wp);
        //             }else{
        //                 let wp = "";
        //         $.each(res, function(key, wallpaper) {
        //             wp += '<div class="col-4 mb-3">'
        //             wp += '<div class="card-img-actions">'
        //             wp += `<img class="card-img-top img-fluid" src="{{ asset('uploads') }}/${wallpaper.image}" alt="${wallpaper.wallpaper_name}">`
        //             wp +=  '<div class="card-img-actions-overlay card-img-top">'
        //             wp +=  '<a href="{{ asset('uploads') }}/${wallpaper.image}" class="btn btn-outline bg-white text-white border-white border-2 legitRipple" data-popup="lightbox">Preview</a>'
        //             wp +=  '<a href="#" class="btn btn-outline bg-white text-white border-white border-2 ml-2 legitRipple"> Details</a>'
        //             wp +=  '</div>'
        //             wp +=  '</div>'
        //             wp +=  '</div>';
        //         });
        //         $('#wallpaperRow').html(wp);
        //             }
        //         }
        //     });

        // })




       

    </script>





</x-sg-master>
