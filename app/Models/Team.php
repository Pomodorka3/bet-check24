<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function footballMatches()
    {
        return $this->hasMany(FootballMatch::class, 'team_1_id')
            ->orWhere('team_2_id', $this->id);
    }
}
