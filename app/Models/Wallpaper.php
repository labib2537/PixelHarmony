<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model
{
    use HasFactory;
    protected $fillable = [
        'wallpaper_name',
        'category',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
