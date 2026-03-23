<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'slug',
        'name',
        'description',
        'logo',
        'cover_image',
        'email',
        'phone',
        'website',
        'address',
        'city',
        'country',
        'organization_type',
        'industry',
        'is_verified',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function organizers(){
        return $this->hasMany(Organizer::class);
    }
}
