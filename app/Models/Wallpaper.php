<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallpaper extends Model
{
    use HasFactory;
    use SoftDeletes;

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
