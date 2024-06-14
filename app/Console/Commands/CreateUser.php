<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $password = $this->argument('password');

        User::create([
            'name' => 'Rob Watson',
            'email' => 'rob.watson@me.com',
            'password' => Hash::make($password),
        ]);

        return self::SUCCESS;
    }
}
