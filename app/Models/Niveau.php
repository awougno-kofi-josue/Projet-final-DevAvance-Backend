<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $fillable = ['nom', 'parcours_id'];

    public function parcours()
    {
        return $this->belongsTo(Parcours::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
