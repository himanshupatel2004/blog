<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // use HasFactory;
    protected $fillable = [
        'name',
        'state_id',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}