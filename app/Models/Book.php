<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag',
        'description',
        'price',
    ];

    public function getTag()
    {
        return 'tag';
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
