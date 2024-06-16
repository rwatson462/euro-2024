<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTeamToLeagueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'team_id' => 'required|string',
        ];
    }
}
