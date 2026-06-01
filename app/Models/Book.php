<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'description',
        'prix',
        'auteur',
        'cover',
        'langue',
        'editeur',
        'category_id',
        'type_id',
    ];

    protected $attributes = [
        'cover' => 'The idiot.jpg',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
