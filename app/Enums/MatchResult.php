<?php

namespace App\Enums;

enum MatchResult: string
{
    case Winner = 'winner';

    case Loser = 'loser';

    case Draw = 'draw';

    public function isWinner(): bool
    {
        return $this === self::Winner;
    }

    public function isLoser(): bool
    {
        return $this === self::Loser;
    }

    public function isDraw(): bool
    {
        return $this === self::Draw;
    }
}
