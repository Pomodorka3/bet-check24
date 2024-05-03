<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user', 'community_id', 'user_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
