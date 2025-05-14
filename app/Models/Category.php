<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Todo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id'];

    // Relasi satu kategori punya banyak todo
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
