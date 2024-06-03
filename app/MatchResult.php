<?php

namespace App;

enum MatchResult: string
{
    case Winner = 'winner';

    case Loser = 'loser';
}
