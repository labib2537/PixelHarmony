<?php

namespace App\Http\Controllers;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Uuid;

class WallpaperController extends Controller
{
    public function upload()
    {
        return view('user.upload');
    }

    public function store(Request $request)
    {
         $wallpaper = new Wallpaper;
         $wallpaper->uuid = chr(rand(65, 90)) . Str::random(31);
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
    // public function display()
    // {
    //     $wallpapers = Wallpaper::orderBy('id', 'desc')->get();
    //     return view('user.view', compact('wallpapers'));
    // }

    public function display()
    {
        // $wallpapers = Wallpaper::orderBy('id', 'desc')->get();
        return view('user.view');
    }



    // Ajax live search
    public function search(Request $request)
    {
        $wallpaper = Wallpaper::where('wallpaper_name', 'like', '%'.$request->search.'%')
                   ->orWhere('category','like','%'.$request->search.'%')       
                   ->orderBy('id', 'desc')
                   ->get();

        if($wallpaper->count()>=1)
        {
            return response()->json($wallpaper);
        }else{
            return response()->json([
                'status' => 250
            ]);
        }           
    }
    // optional: php method
    public function searchWallpaper(Request $request)
    {
        $search = $request->searchInput;
        $wallpapers = Wallpaper::where('wallpaper_name','like','%'.$search.'%')->orWhere('category','like','%'.$search.'%') 
                                ->orderBy('id', 'desc')
                                ->get();
        return view('user.view', compact('wallpapers'));

    }

    public function delete(Request $request)
    {
        $wallpaper = Wallpaper::find($request->id);
        $imagePath = public_path('uploads/'.$wallpaper->image);
        if(file_exists($imagePath))
        {
            unlink($imagePath);
        }
        $wallpaper->delete();
    }

    public function edit(Request $request)
    {
        $wallpaper = Wallpaper::find($request->id);
        return response()->json($wallpaper);
    }

    public function update(Request $request)
    {
        $wallpaper = Wallpaper::find($request->id);
         $wallpaper->uuid = $request->uuid;
         $wallpaper->wallpaper_name = $request->wp_name;
         $wallpaper->category = $request->category;
         $wallpaper->update();
         return response()->json([
            'status' => 200
         ]);
        
    }

}
