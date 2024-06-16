<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFixtureRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'home_team_id' => 'required|string',
            'away_team_id' => 'required|string',
            'kickoff_time' => 'required|date',
        ];
    }
}
