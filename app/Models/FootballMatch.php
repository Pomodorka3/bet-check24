<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_1_id',
        'team_2_id',
        'team_1_score',
        'team_2_score',
        'starts_at',
        'evaluated'
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'evaluated' => 'boolean'
        ];
    }

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }
}
