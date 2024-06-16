<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'home_team_score' => 'required|int|min:0',
            'away_team_score' => 'required|int|min:0',
        ];
    }
}
