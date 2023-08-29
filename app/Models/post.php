<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use App\Models\Category;

class post extends Model
{
    use HasFactory;
    protected $fillable = ['title','content','slug','cover_image','category_id'];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public static function generateSlug($title){
        return Str::slug($title,'-');
    }

}
