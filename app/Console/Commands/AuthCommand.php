<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

class AuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:auth {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will help you to auth with your user and get a token.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->argument('username');
        $password = $this->argument('password');
        // Authenticate the user
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            // Generate a token
            $token = Auth::user()->createToken('Token')->accessToken;
            // Save the token to the user's session
            session(['auth_token' => $token]);

            // Set the token expiration time
            session(['auth_token_expires_at' => now()->addMinutes(5)]);

            $this->info("Token: $token");
            // BE CAREFUL WITH THIS TOKEN, IN MY PHPSTORM I COULD NOT COPY IT IN ONE LINE, SO MAKE SURE IT IS COPIED IN ONE LINE
        } else {
            $this->error('Invalid login credentials.');
        }
        return Command::SUCCESS;
    }
}
