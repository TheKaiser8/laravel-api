<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['slug'];
    protected $appends = ['image_url'];

    // metodo per aggiungere una proprietà al model se non abbiamo una colonna a database con l'obiettivo di restituire l'url completo dell'immagine
    protected function getImageUrlAttribute()
    {
        return $this->picture ? asset("storage/$this->picture") : 'https://via.placeholder.com/400x200';
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
