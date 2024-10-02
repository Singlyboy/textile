<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps=false;
    public function parts()
    {
        return $this->hasMany(Part::class, 'category_id', 'id'); // Adjust these parameters if needed
    }
}
