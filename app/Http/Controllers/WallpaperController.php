<?php

namespace App\Http\Controllers;
use App\Models\Wallpaper;
use Illuminate\Http\Request;

class WallpaperController extends Controller
{
    public function upload()
    {
        return view('user.upload');
    }

    public function store(Request $request)
    {
         $wallpaper = new Wallpaper;
         $wallpaper->wallpaper_name = $request->wp_name;
         $wallpaper->category = $request->category;
         if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $wallpaper->image = $filename;
         }
         $wallpaper->save();
         return response()->json([
            'status' => 200
         ]);
        
    }

    public function fetchAllData()
    {
        $wallpapers = Wallpaper::orderBy('id', 'desc')->get();
        return response()->json($wallpapers);
    }

    
    // display by php procedure
    public function display()
    {
        $wallpapers = Wallpaper::orderBy('id', 'desc')->get();
        return view('user.view', compact('wallpapers'));
    }



    // public function search(Request $request)
    // {
    //     $wallpaper = Wallpaper::where('wallpaper_name', 'like', '%'.$request->search.'%')      
    //                ->orderBy('id', 'desc')
    //                ->get();

    //     if($wallpaper->count()>=1)
    //     {
    //         return response()->json($wallpaper);
    //     }else{
    //         return response()->json([
    //             'status' => 250
    //         ]);
    //     }           
    // }

    public function searchWallpaper(Request $request)
    {
        $search = $request->searchInput;
        $wallpapers = Wallpaper::where('wallpaper_name','like','%'.$search.'%')->orWhere('category','like','%'.$search.'%') 
                                ->orderBy('id', 'desc')
                                ->get();
        return view('user.view', compact('wallpapers'));

    }
}
