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
        return $this->hasMany(Bet::class, 'match_id');
    }

    public function evaluate()
    {
        $bets = $this->bets;
        foreach ($bets as $bet) {

            if ($this->team_1_score === $bet->team_1_score && $this->team_2_score === $bet->team_2_score) {
                // Correct score
                $points = 8;
            } elseif (($this->team_1_score - $this->team_2_score) === ($bet->team_1_score - $bet->team_2_score)) {
                // Correct goal difference
                $points = 6;
                if ($this->team_1_score === $this->team_2_score) {
                    // Correct goal difference and draw
                    $points = 4;
                }
            } elseif ($bet->team_1_score > $bet->team_2_score && $this->team_1_score > $this->team_2_score
                || $bet->team_2_score > $bet->team_1_score && $this->team_2_score > $this->team_1_score) {
                // Correct winner aka "correct tendency"
                $points = 4;
            } else {
                // No points
                $points = 0;
            }

            // Update only if points are greater than 0
            if ($points > 0)
                $bet->user->update([
                    'points' => $points
                ]);
        }

        $this->evaluated = true;
        $this->save();
    }
}
